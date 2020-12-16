<?php


namespace Watermarker\Domain\Models;


use Watermarker\Domain\Interfaces\Image;
use Watermarker\Domain\Interfaces\PDFFile;

class Watermarker
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

    public function allPages(PDFFile $file)
    {
        $totalPages = $file->getTotalPages();

        $this->range($file, 1, $totalPages);
    }

    public function range(PDFFile $file, int $start, int $end)
    {
        $end = $end !== null ? $end : $file->getTotalPages();

        for ($ctr = 1; $ctr <= $end; $ctr++) {
            $file->watermarkPage($ctr, $this->imageWatermark, $this->position, $this->asBackground);
        }
    }
}
