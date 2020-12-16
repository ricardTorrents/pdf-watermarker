<?php

namespace Watermarker\Domain\Interfaces;

interface PDFFile
{
    public function getTotalPages(): int;

    public function watermarkPage(int $pageNumber, Image $watermark, string $position, bool $asBackground, bool $isVisible = true);

    public function getBuffer();

}
