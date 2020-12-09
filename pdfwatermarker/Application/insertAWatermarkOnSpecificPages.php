<?php


class InsertAWatermarkOnSpecificPages {
    private $watermark;
    private $pdf;
    private $specificPages;
    private $outputPath;

    public function __construct(PdfInsertWatermark $pdf,PDFWatermark $watermark, string $outputPath,array $specificPages)
	{	
        $this->pdf=$pdf;
        $this->watermark=$watermark;
        $this->specificPages=$specificPages;
        $this->outputPath=$outputPath;

    }

    
   
    public function insert()
    {
        $totalPages = $this->pdf->getTotalPages();
        for($ctr = 1; $ctr <= $totalPages; $ctr++){
          
            if ( in_array($ctr, $this->specificPages ) ){
				$this->pdf->watermarkOnSpecificPage($ctr,$this->watermark);
			}else{
                $this->pdf->no_insertOnThisPage($ctr);
              
            }
        }
       //Save Pdf
        
    } 
   

   
    
}
?>