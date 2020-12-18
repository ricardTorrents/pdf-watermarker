<?php

namespace Watermarker\Domain\Models;

use InvalidArgumentException;
use Watermarker\Domain\Interfaces\Image;

abstract class ImageWatermark implements Image
{
    protected $file;
    protected $height;
    protected $width;
    private const IMAGE_DPI = 96;
    private const DPI_TO_MM = 25.4;

    public function __construct(string $filePath)
    {
        $this->file = $this->prepareImage($filePath);
        $this->validatePath();
        $this->getImageSize($this->file);

    }

    private function validatePath(): void
    {
        $result = file_exists($this->file);
        if ($result != 1) {
            throw new InvalidArgumentException("Image doesn't exist.");
        }

    }

    private function getImageSize(string $image): void
    {
        $is = getimagesize($image);
        $this->width = $is[0];
        $this->height = $is[1];
    }

    abstract public function prepareImage(string $filePath): string;

    public function getFilePath(): string
    {
        return $this->file;
    }

    public function getMMDimensions(): array
    {
        return array(
            ($this->width / self::IMAGE_DPI) * self::DPI_TO_MM,
            ($this->height / self::IMAGE_DPI) * self::DPI_TO_MM,
        );
    }
}



