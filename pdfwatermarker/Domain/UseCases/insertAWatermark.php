<?php
use setasign\Fpdi\Fpdi;

class InsertAWatermark {
    private $watermark;
    private $pdf;
    private $specificPages;

    public function __construct(PdfRepository $pdf,PDFWatermark $watermark,$specificPages= array())
	{	
        $this->pdf=$pdf;
        $this->watermark=$watermark;
        $this->specificPages=$specificPages;

    }

    
    private function watermarkOnSpecificPage(int $page_number):void
    {
        
        $templateDimension = $this->pdf->getPdfPageSize($page_number);
   
		
		$wWidth = ($this->watermark->getWidth() / 96) * 25.4; //in mm
		$wHeight = ($this->watermark->getHeight() / 96) * 25.4; //in mm
        
		$watermarkCoords = new Cordinates( $this->_watermark->getPosition(), $wWidth, 
																	$wHeight, 
																	$templateDimension['w'], 
                                                                    $templateDimension['h']);					
	
        $this->pdf->updateTmpPdfPage($watermarkCoords,$watermark,$page_number);

	}
    public function insert():PdfRepository
    {
        $totalPages = $this->pdf->getTotalPages();
        echo "Pages: $totalPages\n";
        for($ctr = 1; $ctr <= $totalPages; $ctr++){
            $this->pdf->importPDFPage($ctr);
            if ( in_array($ctr, $this->specificPages ) || empty( $this->specificPages ) ) {
				$this->watermarkOnSpecificPage($ctr);
			}else{
                $this->pdf->useTemplate($ctr);
            }
        }
        return $this->pdf;
        
    } 
   

   
    
}
?>