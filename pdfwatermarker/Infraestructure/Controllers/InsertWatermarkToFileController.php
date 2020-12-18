<?php

namespace Watermarker\Infraestructure\Controllers;

use Watermarker\Application\InsertWatermarkToFile;
use Watermarker\Domain\Factory\ImageWatermarkFactory;
use Watermarker\Domain\ValueObjects\PositionEnum;
use Watermarker\Infraestructure\FPDI\FPDIRepository;

class InsertWatermarkToFileController
{
    private FPDIRepository $repository;

    public function __construct()
    {
        $this->repository = new FPDIRepository();
    }

    public function execute(string $inputPath,
                            string $outputPath,
                            string $watermarkPath,
                            string $position = PositionEnum::CENTER,
                            bool $asBackground = false): void
    {
        $imageWatermark = ImageWatermarkFactory::build($watermarkPath);
        $insertWatermarkToFile = new InsertWatermarkToFile($this->repository, $imageWatermark);
        $insertWatermarkToFile->execute($inputPath, $outputPath, $position, $asBackground);
    }
}
