<?php

namespace Watermarker\Domain\Interfaces;


interface PDFFile
{
    public function watermarkAll(Image $imageWatermark, string $position, bool $asBackground): void;

    public function watermarkRange(int $start, int $end, Image $imageWatermark, string $position, bool $asBackground): void;

    public function getBuffer();

}
