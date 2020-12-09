<?php
class insertWatermarkController{
    private $insertAWatermark;

    public function __construct(InsertAWatermark $insertAWatermark)
	{	
       $this->insertAWatermark=$insertAWatermark;
    
    }
    private function construct_elements(ImageWatermarkPNG $image,string $outputPath):insertWatermarkController
    {
        $watermark = new PDFWatermark($imageWatermark,$position,$background);
        $pdf = FpdiPdf::pdf($inputPath);
        return new self(new InsertAWatermark($pdf,$watermark,$outputPath));
    }

    public static function insertWatermarkPNG(string $inputPath,string $outputPath,string $imagePath,$position,$background): insertWatermarkController
    {
        $imageWatermark=new ImageWatermarkPNG($imagePath);
        return $this->construct_elements($imageWatermark,$outputPath);
    }
    public static function insertWatermarkJPG(string $inputPath,string $outputPath,string $imagePath,$position,$background): insertWatermarkController
    {
        $imageWatermark=new ImageWatermarkJPG($imagePath);
        return $this->construct_elements($imageWatermark,$outputPath);
    }

    public function insert():void
    {
        $this->insertAWatermark->insert();
    }

}