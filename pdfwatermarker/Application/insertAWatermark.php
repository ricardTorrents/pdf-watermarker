<?php
use setasign\Fpdi\Fpdi;

class InsertAWatermark {
    private $watermark;
    private $pdf;
    private $specificPages;

    public function __construct(PdfInsertWatermark $pdf,PDFWatermark $watermark,$specificPages= array())
	{	
        $this->pdf=$pdf;
        $this->watermark=$watermark;
        $this->specificPages=$specificPages;

    }

    
   
    public function insert():PdfInsertWatermark
    {
        $totalPages = $this->pdf->getTotalPages();
        for($ctr = 1; $ctr <= $totalPages; $ctr++){
          
            if ( in_array($ctr, $this->specificPages ) || empty( $this->specificPages ) ) {
				$this->pdf->watermarkOnSpecificPage($ctr,$this->watermark);
			}else{
                $this->pdf->no_insertOnThisPage($ctr);
              
            }
        }
        return $this->pdf;
        
    } 
   

   
    
}
?>