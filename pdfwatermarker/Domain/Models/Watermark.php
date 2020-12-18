<?php


namespace Watermarker\Domain\Models;


use Watermarker\Domain\Interfaces\Image;
use Watermarker\Domain\Interfaces\PDFFile;

class Watermark
{
    private $imageWatermark;
    private $position;
    private $asBackground;

    public function __construct(Image $imageWatermark, string $position, bool $asBackground)
    {

        $this->imageWatermark = $imageWatermark;
        $this->position = $position;
        $this->asBackground = $asBackground;
    }

   

   
}
