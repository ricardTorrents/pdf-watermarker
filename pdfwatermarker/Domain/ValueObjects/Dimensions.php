<?php

class Dimensions {
    protected $pixelHeight;
    protected $pixelWidth;
    private const IMAGE_DPI = 96;
    private const DPI_TO_MM = 25.4;

    public function __construct(int $pixelWidth,int $pixelHeight)
    {
        $this->pixelWidth=$pixelWidth;
        $this->pixelHeight=$pixelHeight;
    }

    public function getMMHeight():float
    {
        return ($this->pixelHeight / self::IMAGE_DPI) * self::DPI_TO_MM;
    }
    public function getMMWidth():float
    {
       return ($this->pixelWidth / self::IMAGE_DPI) * self::DPI_TO_MM;
    }

}