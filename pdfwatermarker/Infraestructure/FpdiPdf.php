<?php
use setasign\Fpdi\Fpdi;

include('PdfRepository.php');
class FpdiPdf implements Pdf, PdfWrite
{
    private $path;
    private $tmpPdf;
    private $n_pages;


    public function __construct(string $pdfPath,Fpdi $tmpPdfInstance)
	{	
        $this->path=$pdfPath;
        $this->vaildatePath();
        $this->tmpPdf=$tmpPdfInstance;
        $this->n_pages=$this->tmpPdf->setSourceFile($this->path);
    }

	/** Dejamos este constructor simplemente para dar Semantica a la construccion */
	public static function pdf(string $pdfPath):FpdiPdfRepository 
	{
        return  new self($pdfPath,new Fpdi());
    }
    public function getPdf():FpdiPdfRepository
    {
        return $this->tmpPdf;
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

    public function useTemplate(int $pageNumber):void {
        $this->tmpPdf->useTemplate($this->importPage($page_number));
    }
    public function getPdfPageSize(int $page_number):array
    {

        $tplIdx = $this->tmpPdf -> importPage($page_number);
        $size =  $this->tmpPdf ->getTemplateSize($tplIdx);
       
       
        return $size;
    }
    public function importPDFPage(int $page_number):void {
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
  

    public function getTotalPages():int {
		return $this->n_pages;
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

}
