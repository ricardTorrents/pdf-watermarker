<?php

namespace Watermarker\Application;

use Watermarker\Domain\Interfaces\Image;
use Watermarker\Domain\Interfaces\PDFRepository;
use Watermarker\Domain\ValueObjects\PositionEnum;

class InsertWatermarkToPageRange
{
    private PDFRepository $repo;
    private Image $imageWatermark;

    public function __construct(PDFRepository $repo, Image $imageWatermark)
    {
        $this->repo = $repo;
        $this->imageWatermark = $imageWatermark;
    }

    public function execute(string $inputPath,
                            string $outputPath,
                            int $start,
                            int $end,
                            string $position = PositionEnum::CENTER,
                            bool $asBackground = false): void
    {
        $inputFile = $this->repo->open($inputPath);
        $inputFile->watermarkRange($start, $end, $this->imageWatermark, $position, $asBackground);
        $this->repo->save($inputFile, $outputPath);
    }
}
