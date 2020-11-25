<?php

interface PdfWrite
{
      // TODO Preguntar: Si tendriamos que pasar el PDF
      public function writeOnFile(string $outPutPath):void;
}
