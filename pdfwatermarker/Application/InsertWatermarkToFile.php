<?php

namespace Watermarker\Application;

use Watermarker\Domain\Factory\ImageWatermarkFactory;
use Watermarker\Domain\Interfaces\PDFRepository;
use Watermarker\Domain\Models\PDFWatermark;
use Watermarker\Domain\Models\Watermarker;
use Watermarker\Domain\ValueObjects\PositionEnum;
use Watermarker\Domain\Interfaces\Image;


class InsertWatermarkToFile
{
    private $repo;

    public function __construct(PDFRepository $repo,Image $imageWatermark)
    {
        $this->repo = $repo;
        $this->imageWatermark=$imageWatermark;
    }


  // Crear un caso de uso para cada una de las funciones.
  // ImageWatermarker passar como colaborador.

    public function execute(string $inputPath,
                            string $outputPath,
                            string $position = PositionEnum::CENTER,
                            bool $asBackground = false): void
    {
        $inputFile = $this->repo->open($inputPath);
        $inputFile->watermarkAll($this->imageWatermark,$position,$asBackground);
        $this->repo->save($inputFile, $outputPath);
    }

    
}
