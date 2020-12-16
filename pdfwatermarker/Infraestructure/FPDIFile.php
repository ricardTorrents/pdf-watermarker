<?php


namespace Watermarker\Infraestructure;


use setasign\Fpdi\Fpdi;
use Watermarker\Domain\Interfaces\Image;
use Watermarker\Domain\Interfaces\PDFFile;
use Watermarker\Domain\ValueObjects\Coordinates;

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


    public function watermarkPage(int $pageNumber, Image $watermark, string $position, bool $asBackground, bool $isVisible = true)
    {
        $templateId = $this->tmpPDF->importPage($pageNumber);
        $templateDimension = $this->tmpPDF->getTemplateSize($templateId);
        if ($templateDimension['width'] > $templateDimension['height']) {
            $orientation = "L";
        } else {
            $orientation = "P";
        }

        $this->tmpPDF->addPage($orientation, array($templateDimension['width'], $templateDimension['height']));
        $watermarkDimension = $watermark->getMMDimensions();
        $coordinates = new Coordinates($position,
            $templateDimension['width'],
            $templateDimension['height'],
            $watermarkDimension[0],
            $watermarkDimension[1]);

        if ($isVisible) {
            if ($asBackground) {
                $this->tmpPDF->Image($watermark->getFilePath(), $coordinates->getX(), $coordinates->getY(), -96);
                $this->tmpPDF->useTemplate($templateId);
            } else {
                $this->tmpPDF->useTemplate($templateId);
                $this->tmpPDF->Image($watermark->getFilePath(), $coordinates->getX(), $coordinates->getY(), -96);
            }
        } else {
            $this->tmpPDF->useTemplate($templateId);
        }
    }
}
