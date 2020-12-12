<?php


class InsertAWatermark {
    private $watermark;
    private $pdf;
    private $outputPath;

    public function __construct(PdfInsertWatermark $pdf,IPdfWatermark $watermark, string $outputPath)
	{	
        $this->pdf=$pdf;
        $this->watermark=$watermark;
        $this->outputPath=$outputPath;
    }

    
   
    public function insert():void
    {
      
        $this->pdf->insertInAllPages($this->watermark);
        
 

        //save PDF 
        $this->pdf->writeOnFile($this->outputPath);
        
    } 
   

   
    
}
?>