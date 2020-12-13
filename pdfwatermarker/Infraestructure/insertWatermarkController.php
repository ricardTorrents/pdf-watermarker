<?php


class InsertWatermarkController{
    private $insertAWatermark;

    public function __construct(InsertAWatermark $insertAWatermark)
	{	
       $this->insertAWatermark=$insertAWatermark;
    
    }
    private function construct_elements(IImageWatermark $image,string $inputPath,string $outputPath,string $position,bool $background):InsertWatermarkController
    {
       
        $watermark = new PDFWatermark($image,$position,$background);
        $pdf = FpdiPdf::pdf($inputPath);
        return new self(new InsertAWatermark($pdf,$watermark,$outputPath));
    }

    public static function insertWatermarkPNG(string $inputPath,string $outputPath,string $imagePath,string $position,bool $background): InsertWatermarkController
    {
        $imageWatermark=new ImageWatermarkPNG($imagePath);
       
        return self::construct_elements($imageWatermark,$inputPath,$outputPath,$position,$background);
    }
    public static function insertWatermarkJPG(string $inputPath,string $outputPath,string $imagePath,string $position, bool $background): InsertWatermarkController
    {
        $imageWatermark=new ImageWatermarkJPG($imagePath);
        return self::construct_elements($imageWatermark,$inputPath,$outputPath,$position,$background);
    }

    public function insert():void
    {
        $this->insertAWatermark->insert();
    }

}