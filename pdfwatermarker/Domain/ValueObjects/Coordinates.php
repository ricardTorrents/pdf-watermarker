<?php

namespace Watermarker\Domain\ValueObjects;

class Coordinates
{
    private  $x;
    private  $y;

    public function __construct(string $position, int $pageWidth, int $pageHeight,  float $watermarkWidth, float $watermarkHeight)
    {
       
        switch ($position) {
            case PositionEnum::TOPLEFT:
                $this->x = 0;
                $this->y = 0;
                break;
            case PositionEnum::TOPRIGHT:
                $this->x = $pageWidth - $watermarkWidth;
                $this->y = 0;
                break;
            case PositionEnum::BOTTOMRIGHT:
                $this->x = $pageWidth - $watermarkWidth;
                $this->y = $pageHeight - $watermarkHeight;
                break;
            case PositionEnum::BOTTOMLEFT:
                $this->x = 0;
                $this->y = $pageHeight - $watermarkHeight;
                break;
            default:
                $this->x = ($pageWidth - $watermarkWidth) / 2;
                $this->y = ($pageHeight - $watermarkHeight) / 2;
                break;
        }
    }

    

    /**
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }
}

?>
