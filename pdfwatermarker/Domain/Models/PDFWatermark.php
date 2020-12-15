<?php

namespace Watermarker\Domain\Models;

use Watermarker\Domain\Interfaces\IPdfWatermark;
use Watermarker\Domain\Interfaces\Image;
use Watermarker\Domain\ValueObjects\PositionEnum;

//position 'center','topright', 'topleft', 'bottomright', 'bottomleft'

/**
 * PDFWatermark.php
 *
 * This class defines properties of a watermark
 * @author Binarystash <binarystash01@gmail.com>
 * @version 1.1.1
 * @license https://opensource.org/licenses/MIT MIT
 */

 // Include 
class PDFWatermark implements IPdfWatermark
{

    private $imageWatermark;
    private $position;
    private $asBackground;

    public function __construct(Image $imageWatermark, string $position, bool $asbackground)
    {

        $this->imageWatermark = $imageWatermark;
        $this->position = $position;
      
        $this->asBackground = $asbackground;
    }

    /** Dejamos este constructor simplemente para dar Semantica a la construccion */
    public static function contructCenterOverlay(Image $imageWatermark)
    {
        return new self($imageWatermark, PositionEnum::CENTER, false);
    }

    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    public function setAsBackground(): void
    {
        $this->asBackground = true;
    }

    public function setAsOverlay(): void
    {
        $this->asBackground = false;
    }


    public function usedAsBackground(): bool
    {
      
        return $this->asBackground;
    }


    public function getPosition(): string
    {
        return $this->position;
    }

    public function getFilePath(): string
    {
        return $this->imageWatermark->getFilePath();
    }


    public function getMMDimension(): array
    {
        return $this->imageWatermark->getMMDimensions();
    }

}


