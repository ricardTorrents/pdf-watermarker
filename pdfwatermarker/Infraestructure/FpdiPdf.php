<?php
require_once 'pdfwatermarker/Domain/Interfaces/PdfInsertWatermark.php' ;
use setasign\Fpdi\Fpdi;


class FpdiPdf implements PdfInsertWatermark
{
    private $path;
    private $tmpPdf;
    private $n_pages;
    private const WIDTH= 'width';
    private const HEIGHT = 'height';

    public function __construct(string $pdfPath, Fpdi $tmpPdfInstance)
    {
        $this->path = $pdfPath;
        $this->vaildatePath();
        $this->tmpPdf = $tmpPdfInstance;
        $this->n_pages = $this->tmpPdf->setSourceFile($this->path);
    }

    /** Dejamos este constructor simplemente para dar Semantica a la construccion */
    public static function pdf(string $pdfPath): PdfInsertWatermark
    {
        return new self($pdfPath, new Fpdi());
    }

    public function getPdf(): PdfInsertWatermark
    {
        return $this->tmpPdf;
    }

    public function insertInSpecificPages($watermark,$specificPages):void
    {
        $totalPages = $this->n_pages;
        for($ctr = 1; $ctr <= $totalPages; $ctr++){
          
            if ( in_array($ctr, $specificPages ) ){
				$this->watermarkOnSpecificPage($ctr,$watermark);
			}else{
               $this->no_insertWatermarkOnThisPage($ctr);
              
            }
        }
    }
    public function insertInAllPages($watermark):void
    {
        $totalPages = $this->n_pages;
     
        for($ctr = 1; $ctr <= $totalPages; $ctr++){
          
           $this->watermarkOnSpecificPage($ctr,$watermark);
		
        }
    }

    private function no_insertWatermarkOnThisPage(int $page_number): void
    {
        $this->importPDFPage($page_number);
        $this->useTemplate($page_number);
    }

    private function watermarkOnSpecificPage(int $page_number, PDFWatermark $watermark): void
    {
        $this->importPDFPage($page_number);
        $templateDimension = $this->getPdfPageSize($page_number);
        $watermarkDimension = $watermark->getMMDimension();

        $watermarkCoords = new Coordinates($watermark->getPosition(),
           
            $templateDimension[self::WIDTH],
            $templateDimension[self::HEIGHT],
            $watermarkDimension[0],
            $watermarkDimension[1]);

  
        $this->updateTmpPdfPage($watermarkCoords, $watermark, $page_number);

    }

    public function writeOnFile(string $outputPath): void
    {
        $this->tmpPdf->Output("F", $outputPath);

    }

    private function vaildatePath(): void
    {
        $result = file_exists($this->path);
        if ($result != 1) {
            throw new InvalidArgumentException("TEST Inputted PDF file doesn't exist");
        }

    }

    public function updateTmpPdfPage(Coordinates $watermarkCoords, PDFWatermark $watermark, $page_number): void
    {
       	
        if ($watermark->usedAsBackground()) {
            $this->tmpPdf->Image($watermark->getFilePath(), $watermarkCoords->getX(), $watermarkCoords->getY(), -96);
            $this->useTemplate($page_number);
        } else {
            $this->useTemplate($page_number);
            $this->tmpPdf->Image($watermark->getFilePath(), $watermarkCoords->getX(), $watermarkCoords->getY(), -96);
        }
    }

    private function useTemplate(int $pageNumber): void
    {
        $this->tmpPdf->useTemplate($this->tmpPdf->importPage($pageNumber));
    }

    private function getPdfPageSize(int $page_number): array
    {

        $tplIdx = $this->tmpPdf->importPage($page_number);
        return $this->tmpPdf->getTemplateSize($tplIdx);


    
    }

    private function importPDFPage(int $page_number): void
    {
        $tplIdx = $this->tmpPdf->importPage($page_number);
        $size = $this->tmpPdf->getTemplateSize($tplIdx);

        if ($size[self::WIDTH] > $size[self::HEIGHT]) {
            $orientation = "L";
        } else {
            $orientation = "P";
        }
        if ($size[self::WIDTH] == null or $size[self::HEIGHT] == null) {
            throw new UnexpectedValueException("Dimensions error");
        }

        $this->tmpPdf->addPage($orientation, array($size[self::WIDTH], $size[self::HEIGHT]));

    }

}
