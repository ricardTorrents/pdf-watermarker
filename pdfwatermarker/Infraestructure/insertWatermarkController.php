<?php

namespace Watermarker\Infraestructure;

use Watermarker\Application\InsertWatermark;
use Watermarker\Domain\ValueObjects\PositionEnum;

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
        $insertWatermarkToFile->allPages($inputPath, $outputPath, $watermarkPath,$position,$asBackground);
    }

}
