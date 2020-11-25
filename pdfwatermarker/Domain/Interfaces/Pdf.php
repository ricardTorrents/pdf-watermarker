<?php

interface Pdf
{
    public function getTotalPages():int;
    public function importPDFPage(int $pageNumber):void;
    public function getPdfPageSize(int $pageNumber):array;
    public function useTemplate(int $pageNumber):void;
    public function updateTmpPdfPage(Coordinates $watermarkCoords,Watermark $watermark,$page_number):void;
   
}
