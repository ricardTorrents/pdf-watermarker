<?php

namespace Watermarker\Domain\Interfaces;

interface PDFRepository
{
    public function open(string $inputPath): PDFFile;

    public function save(PDFFile $file, string $filename);


}

