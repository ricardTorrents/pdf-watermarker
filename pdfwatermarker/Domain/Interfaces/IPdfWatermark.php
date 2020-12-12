<?php


interface IPdfWatermark 
{

   //Possiblemente se elimine
    public static function contructCenterOverlay(IImageWatermark $imageWatermark): PDFWatermark;
   

    public function setPosition(string $position): void;
    

    public function setAsBackground(): void;
   

    public function setAsOverlay(): void;
   


    public function usedAsBackground(): bool;
   

    public function getPosition(): string;
    

    public function getFilePath(): string;
    


    public function getMMDimension(): array;
   

}


