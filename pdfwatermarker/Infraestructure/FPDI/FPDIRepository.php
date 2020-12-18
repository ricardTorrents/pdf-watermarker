<?php


namespace Watermarker\Infraestructure\FPDI;

use Watermarker\Domain\Interfaces\PDFFile;
use Watermarker\Domain\Interfaces\PDFRepository;
use InvalidArgumentException;
class FPDIRepository implements PDFRepository
{

    public function open(string $inputPath): PDFFile
    {
        return new FPDIFile($inputPath);

    }


    public function save(PDFFile $file, string $filename)
    {
        if (!file_put_contents($filename, $file->getBuffer())) {
            throw new InvalidArgumentException("Unable to create output file: " . $filename);
        }
    }
}
