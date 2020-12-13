<?php


interface IPdfWatermark 
{
    public static function contructCenterOverlay(Image $imageWatermark): PDFWatermark;
   
    public function setPosition(string $position): void;

    public function setAsBackground(): void;

    public function setAsOverlay(): void;
   
    public function usedAsBackground(): bool;

    public function getPosition(): string;
    
    public function getFilePath(): string;
    
    public function getMMDimension(): array;
   
}


