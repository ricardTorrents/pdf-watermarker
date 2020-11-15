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

    private function _calculateWatermarkCoordinates( int $wWidth, int $wHeight, int $tWidth, int $tHeight ):array 
    {
		
		switch( $this->_watermark->getPosition() ) {
			case 'topleft': 
				$x = 0;
				$y = 0;
				break;
			case 'topright':
				$x = $tWidth - $wWidth;
				$y = 0;
				break;
			case 'bottomright':
				$x = $tWidth - $wWidth;
				$y = $tHeight - $wHeight;
				break;
			case 'bottomleft':
				$x = 0;
				$y = $tHeight - $wHeight;
				break;
			default:
				$x = ( $tWidth - $wWidth ) / 2 ;
				$y = ( $tHeight - $wHeight ) / 2 ;
				break;
		}
		
		return array($x,$y);
    }
    private function watermarkOnSpecificPage(int $page_number):void
    {
        
        $templateDimension = $this->pdf->getPdfPageSize($page_number);
   
		
		$wWidth = ($this->watermark->getWidth() / 96) * 25.4; //in mm
		$wHeight = ($this->watermark->getHeight() / 96) * 25.4; //in mm
        
		$watermarkCoords = $this->_calculateWatermarkCoordinates( 	$wWidth, 
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