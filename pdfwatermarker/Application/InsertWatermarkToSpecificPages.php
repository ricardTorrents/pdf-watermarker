<?php

namespace Watermarker\Application;

class InsertWatermarkToSpecificPages {
    private $watermark;
    private $pdf;
    private $specificPages;
    private $outputPath;

    public function __construct(PdfInsertWatermark $pdf,IPdfWatermark $watermark, string $outputPath,array $specificPages)
	{	
        $this->pdf=$pdf;
        $this->watermark=$watermark;
        $this->specificPages=$specificPages;
        $this->outputPath=$outputPath;

    }

    
   
    public function insert()
    {
        $this->pdf->insertInSpecificPages($this->watermark,$this->specificPages);
       //Save Pdf
        $this->pdf->writeOnFile($this->outputPath);
    } 
   

   
    
}
?>