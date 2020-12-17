<?php

namespace Watermarker\Infraestructure\Controllers;

use Watermarker\Application\InsertWatermarkAll;
use Watermarker\Application\InsertWatermarkRange;
use Watermarker\Domain\ValueObjects\PositionEnum;
use Watermarker\Domain\Factory\ImageWatermarkFactory;
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
        $imageWatermark= ImageWatermarkFactory::build($watermarkPath);
        $insertWatermarkToFile = new InsertWatermarkAll($repo,$imageWatermark);
     
        $insertWatermarkToFile->execute($inputPath, $outputPath, $position, $asBackground);
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
        $imageWatermark= ImageWatermarkFactory::build($watermarkPath);
        $insertWatermarkToFile = new InsertWatermarkRange($repo,$imageWatermark);
        $insertWatermarkToFile->execute($inputPath, $outputPath, $start, $end, $position, $asBackground);
    }

}
