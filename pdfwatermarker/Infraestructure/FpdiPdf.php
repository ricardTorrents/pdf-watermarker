<?php
use setasign\Fpdi\Fpdi;

include('../Domain/Interfaces/PdfInsertWatermark.php');
class FpdiPdf implements PdfInsertWatermark, PdfWrite
{
    private $path;
    private $tmpPdf;
    private $n_pages;
    const INCHES_FACTOR=25.4;
    const DIVISOR_CONVERTION=96;


    public function __construct(string $pdfPath,Fpdi $tmpPdfInstance)
	{	
        $this->path=$pdfPath;
        $this->vaildatePath();
        $this->tmpPdf=$tmpPdfInstance;
        $this->n_pages=$this->tmpPdf->setSourceFile($this->path);
    }

	/** Dejamos este constructor simplemente para dar Semantica a la construccion */
	public static function pdf(string $pdfPath):PdfInsertWatermark 
	{
        return  new self($pdfPath,new Fpdi());
    }

    public function getPdf():PdfInsertWatermark
    {
        return $this->tmpPdf;
    }

    
  

    public function getTotalPages():int {
		return $this->n_pages;
    }
    public function no_insertWatermarkOnThisPage(int $page_number):void 
    {
        $this->importPDFPage($page_number);
        $this->useTemplate($page_number);
    }
    public function watermarkOnSpecificPage(int $page_number,PDFWatermark $watemark):void
    {
        $this->importPDFPage($page_number);
        $templateDimension = $this->getPdfPageSize($page_number);
   
		
		$wWidth = ($watermark->getWidth() / self::DIVISOR_CONVERTION) * self::INCHES_FACTOR; //in mm
		$wHeight = ($watermark->getHeight() / self::DIVISOR_CONVERTION) * self::INCHES_FACTOR; //in mm
        
		$watermarkCoords = new Cordinates( $twatermark->getPosition(), $wWidth, 
																	$wHeight, 
																	$templateDimension['w'], 
                                                                    $templateDimension['h']);					
	
        $this->updateTmpPdfPage($watermarkCoords,$watermark,$page_number);

	}
    public function writeOnFile(string $outputPath ):void 
    {
        $this->tmpPdf->Output("F",$outputPath);

    }
	private function vaildatePath():void
    {   
        $result=file_exists( $this->path );
        if ( $result !=1 ) {
			throw new Exception("TEST Inputted PDF file doesn't exist");
        }
        
    }

    public function updateTmpPdfPage(Coordinates $watermarkCoords,Watermark $watermark,$page_number):void {
             
		if ( $watermark->usedAsBackground() ) {															
            $this->tmpPdf->Image($watermark->getFilePath(),$watermarkCoords->getX(),$watermarkCoords->getY(),-96);
            $this->useTemplate($page_number);
        }
        else {
            $this->useTemplate($page_number);
            $this->tmpPdf->Image($watermark->getFilePath(),$watermarkCoords->getX(),$watermarkCoords->getY(),-96);
        }
    }

    private function useTemplate(int $pageNumber):void {
        $this->tmpPdf->useTemplate($this->tmpPdf->importPage($page_number));
    }
    private function getPdfPageSize(int $page_number):array
    {

        $tplIdx = $this->tmpPdf -> importPage($page_number);
        $size =  $this->tmpPdf ->getTemplateSize($tplIdx);
       
       
        return $size;
    }
    private function importPDFPage(int $page_number):void {
		$tplIdx = $this->tmpPdf->importPage($page_number);
        $size =  $this->tmpPdf->getTemplateSize($tplIdx);
        
		if ( $size['w'] > $size['h'] ) {
			$orientation = "L";
		}
		else {
			$orientation = "P";
        }
        if( $size['w']==null or $size['h']==null ){
            throw new Exception("Dimensions error");
        }
      
		$this->tmpPdf->addPage($orientation,array($size['w'],$size['h']));
		
	}

}
