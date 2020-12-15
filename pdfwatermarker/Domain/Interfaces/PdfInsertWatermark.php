<?php

namespace Watermarker\Domain\Interfaces;

use Watermarker\Domain\Models\PDFWatermark;

interface PdfInsertWatermark
{
    public function insertInAllPages(PDFWatermark $watemark):void;
    public function insertInSpecificPages(PDFWatermark $watemark,array $specificPages):void;
}
