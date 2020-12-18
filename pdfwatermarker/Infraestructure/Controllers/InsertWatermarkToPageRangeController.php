<?php

namespace Watermarker\Infraestructure\Controllers;

use Watermarker\Application\InsertWatermarkToPageRange;
use Watermarker\Domain\Factory\ImageWatermarkFactory;
use Watermarker\Domain\ValueObjects\PositionEnum;
use Watermarker\Infraestructure\FPDI\FPDIRepository;

class InsertWatermarkToPageRangeController
{
    private FPDIRepository $repository;

    public function __construct()
    {
        $this->repository = new FPDIRepository();
    }

    public function execute(string $inputPath,
                            string $outputPath,
                            string $watermarkPath,
                            int $start,
                            int $end,
                            string $position = PositionEnum::CENTER,
                            bool $asBackground = false): void
    {
        $imageWatermark = ImageWatermarkFactory::build($watermarkPath);
        $insertWatermarkToFile = new InsertWatermarkToPageRange($this->repository, $imageWatermark);
        $insertWatermarkToFile->execute($inputPath, $outputPath, $start, $end, $position, $asBackground);
    }

}
