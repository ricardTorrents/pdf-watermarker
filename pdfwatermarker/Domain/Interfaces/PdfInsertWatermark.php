<?php

interface PdfInsertWatermark
{
    public function getTotalPages(): int;

    public function watermarkOnSpecificPage(int $pageNumber, PDFWatermark $watemark): void;

    public function no_insertWatermarkOnThisPage(int $pageNumber): void;

}
