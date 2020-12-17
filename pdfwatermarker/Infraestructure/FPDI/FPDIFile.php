<?php


namespace Watermarker\Infraestructure\FPDI;


use setasign\Fpdi\Fpdi;
use Watermarker\Domain\Interfaces\Image;
use Watermarker\Domain\Interfaces\PDFFile;
use Watermarker\Domain\ValueObjects\Coordinates;
use Watermarker\Domain\ValueObjects\PositionEnum;

class FPDIFile implements PDFFile
{

    private $tmpPDF;
    private $totalPages;

    public function __construct(string $inputPath)
    {
        $this->tmpPDF = new FPDI();
        $this->totalPages = $this->tmpPDF->setSourceFile($inputPath);
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    public function getBuffer()
    {
        return $this->tmpPDF->Output("S");
    }


    // Separar dos funciones una para insertar con watermark y la otra para insertar sin watermark

    // funcion privada para obtener coordenadas
  
   
    private function watermarkPage(int $pageNumber, Image $watermark, string $position, bool $asBackground)
    {
        $templateId = $this->tmpPDF->importPage($pageNumber);
        $templateDimension = $this->tmpPDF->getTemplateSize($templateId);
        $orientation=$this->getOrientation($templateDimension);

        $watermarkDimension=$watermark->getMMDimensions();
        $this->tmpPDF->addPage($orientation, array($templateDimension['width'], $templateDimension['height']));
        $coordinates =new Coordinates($position,
            $templateDimension['width'],
            $templateDimension['height'],
            $watermarkDimension[0],
            $watermarkDimension[1]);

     
        if ($asBackground) {
            $this->tmpPDF->Image($watermark->getFilePath(), $coordinates->getX(), $coordinates->getY(), -96);
            $this->tmpPDF->useTemplate($templateId);
        } else {
            $this->tmpPDF->useTemplate($templateId);
            $this->tmpPDF->Image($watermark->getFilePath(), $coordinates->getX(), $coordinates->getY(), -96);
        }
       
    }
    private function getOrientation(array $templateDimension):string 
    {
        if ($templateDimension['width'] > $templateDimension['height']) {
            $orientation = "L";
        } else {
            $orientation = "P";
        }
        return $orientation;
    }
    private function notWatermarkPage(int $pageNumber):void
    {   
   
    
    
        $templateId = $this->tmpPDF->importPage($pageNumber);
        
        $templateDimension = $this->tmpPDF->getTemplateSize($templateId);
        $orientation=$this->getOrientation($templateDimension);
        $this->tmpPDF->addPage($orientation, array($templateDimension['width'], $templateDimension['height']));
        $this->tmpPDF->useTemplate($templateId);
    }
    
    public function watermarkAll(Image $imageWatermark,string $position, bool $asBackground):void
    {
        $this->watermarkRange(1,$this->totalPages,$imageWatermark,$position,$asBackground);
    }
    public function watermarkRange(int $start, int $end,Image $imageWatermark,string $position, bool $asBackground):void
    {
        

        $end = $end !== null ? $end : $this->totalPages;
        $specificPages = range($start, $end);

        for ($ctr = 1; $ctr <= $this->totalPages; $ctr++) {
            if (in_array($ctr, $specificPages) || empty($specificPages)) {
                $this->watermarkPage($ctr, $imageWatermark, $position, $asBackground);
            } else {
                $this->notWatermarkPage($ctr);
            }

        }
    }
}
