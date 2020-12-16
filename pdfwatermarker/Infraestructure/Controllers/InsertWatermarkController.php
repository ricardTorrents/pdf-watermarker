<?php

namespace Watermarker\Infraestructure\Controllers;

use Watermarker\Application\InsertWatermark;
use Watermarker\Domain\ValueObjects\PositionEnum;
use Watermarker\Infraestructure\FPDI\FPDIRepository;

class InsertWatermarkController
{


    public function insertAllPages(string $inputPath,
                                   string $outputPath,
                                   string $watermarkPath,
                                   string $position = PositionEnum::CENTER,
                                   bool $asBackground = false): void
    {
        $repo = new FPDIRepository();
        $insertWatermarkToFile = new InsertWatermark($repo);
        $insertWatermarkToFile->allPages($inputPath, $outputPath, $watermarkPath, $position, $asBackground);
    }

    public function range(string $inputPath,
                          string $outputPath,
                          string $watermarkPath,
                          int $start,
                          int $end,
                          string $position = PositionEnum::CENTER,
                          bool $asBackground = false): void
    {
        $repo = new FPDIRepository();
        $insertWatermarkToFile = new InsertWatermark($repo);
        $insertWatermarkToFile->range($inputPath, $outputPath, $watermarkPath, $start, $end, $position, $asBackground);
    }

}
