<?php

interface PdfInsertWatermark
{
   
    
    public function insertInAllPages(PDFWatermark $watemark):void;
    public function insertInSpecificPages(PDFWatermark $watemark,array $specificPages):void;

    

}
