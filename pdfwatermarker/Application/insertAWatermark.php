<?php
use setasign\Fpdi\Fpdi;

class InsertAWatermark {
    private $watermark;
    private $pdf;
    private $outputPath;

    public function __construct(PdfInsertWatermark $pdf,PDFWatermark $watermark, string $outputPath)
	{	
        $this->pdf=$pdf;
        $this->watermark=$watermark;
        $this->outputPath=$outputPath;
    }

    
   
    public function insert():void
    {
        $totalPages = $this->pdf->getTotalPages();
        for($ctr = 1; $ctr <= $totalPages; $ctr++){
            $this->pdf->watermarkOnSpecificPage($ctr,$this->watermark);
        
        }

        //save PDF 
        
    } 
   

   
    
}
?>