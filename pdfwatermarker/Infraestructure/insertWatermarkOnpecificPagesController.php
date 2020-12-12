<?php

class insertWatermarkOnpecificPagesController{
    private $insertAWatermarkOnSpecificPages;

    public function __construct(InsertAWatermarkOnSpecificPages $insertAWatermarkOnSpecificPages)
	{	
       $this->insertAWatermarkOnSpecificPages=$insertAWatermarkOnSpecificPages;
    
    }
    private function construct_elements(ImageWatermarkPNG $image,string $outputPath,array $pages):insertWatermarkOnpecificPagesController
    {
        $watermark = new PDFWatermark($imageWatermark,$position,$background);
        $pdf = FpdiPdf::pdf($inputPath);
        return new self(new InsertAWatermarkOnSpecificPages($pdf,$watermark,$outputPath, $pages));
    }

    public static function insertWatermarkPNG(string $inputPath,string $outputPath,string $imagePath,$position,boolean $background,array $pages): insertWatermarkOnpecificPagesController
    {
        $imageWatermark=new ImageWatermarkPNG($imagePath);
        return $this->construct_elements($imageWatermark,$outputPath,$pages);
    }
    public static function insertWatermarkJPG(string $inputPath,string $outputPath,string $imagePath,$position,$background,array $pages): insertWatermarkOnpecificPagesController
    {
        $imageWatermark=new ImageWatermarkJPG($imagePath);
        return $this->construct_elements($imageWatermark,$outputPath,$pages);
    }
    

    public function insert():void
    {
        $this->insertAWatermarkOnSpecificPages->insert();
    }
}