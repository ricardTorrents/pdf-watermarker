<?php

namespace Watermarker\Application;

use Watermarker\Domain\Factory\ImageWatermarkFactory;
use Watermarker\Domain\Interfaces\PDFRepository;
use Watermarker\Domain\Models\PDFWatermark;
use Watermarker\Domain\Models\Watermarker;
use Watermarker\Domain\ValueObjects\PositionEnum;

class InsertWatermark
{
    private $repo;

    public function __construct(PDFRepository $repo)
    {
        $this->repo = $repo;
    }


    private function execute(string $inputPath,
                            string $outputPath,
                            string $watermarkPath,
                            string $position = PositionEnum::CENTER,
                            bool $asBackground = false): void
    {
        $inputFile = $this->repo->open($inputPath);
        $imageWatermark = ImageWatermarkFactory::build($watermarkPath);
        $watermarker = new Watermarker($imageWatermark, $position, $asBackground);
        $watermarker->allPages($inputFile);
        $this->repo->save($inputFile, $outputPath);
    }

    public function allPages(string $inputPath,
                            string $outputPath,
                            string $watermarkPath,
                            string $position = PositionEnum::CENTER,
                            bool $asBackground = false): void
    {
        $this->execute($inputPath, $outputPath, $watermarkPath, $position, $asBackground);
    }
}
