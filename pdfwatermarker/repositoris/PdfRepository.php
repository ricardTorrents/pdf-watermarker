<?php

interface PdfRepository 
{
    public function getTotalPages():int;
    public function importPDFPage(int $pageNumber):void;
    public function getPdfPageSize(int $pageNumber):array;
    public function useTemplate(int $pageNumber):void;
    public function updateTmpPdfPage(array $watermarkCoords,Watermark $watermark,$page_number):void;
    public function writeOnFile(string $outPutPath):void;
}