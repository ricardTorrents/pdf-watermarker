<?php
interface ImageWatermark
{
    public function getFilePath():string;
    public function getWidth():int;
    public function getHeight():int; 
    public function prepareImage(string $filePath):string;
}
