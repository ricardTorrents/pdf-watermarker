<?php

class InsertWatermarkOnpecificPagesController{
    private $insertAWatermarkOnSpecificPages;

    public function __construct(InsertAWatermarkOnSpecificPages $insertAWatermarkOnSpecificPages)
	{	
       $this->insertAWatermarkOnSpecificPages=$insertAWatermarkOnSpecificPages;
    
    }
    private function construct_elements(ImageWatermarkPNG $image,string $inputPath, string $outputPath,string $position,bool $background,array $pages):InsertWatermarkOnpecificPagesController
    {
        $watermark = new PDFWatermark($image,$position,$background);
        $pdf = FpdiPdf::pdf($inputPath);
        return new self(new InsertAWatermarkOnSpecificPages($pdf,$watermark,$outputPath, $pages));
    }

    public static function insertWatermarkPNG(string $inputPath,string $outputPath,string $imagePath,string $position,bool $background,array $pages): InsertWatermarkOnpecificPagesController
    {
        $imageWatermark=new ImageWatermarkPNG($imagePath);
        return self::construct_elements($imageWatermark,$inputPath,$outputPath,$position,$background,$pages);
    }
    public static function insertWatermarkJPG(string $inputPath,string $outputPath,string $imagePath,string $position,bool $background,array $pages): InsertWatermarkOnpecificPagesController
    {
        $imageWatermark=new ImageWatermarkJPG($imagePath);
        return self::construct_elements($imageWatermark,$inputPath,$outputPath,$position,$background,$pages);
    }
    

    public function insert():void
    {
        $this->insertAWatermarkOnSpecificPages->insert();
    }
}