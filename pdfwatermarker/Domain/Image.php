<?php
interface Image {
    public function getFilePath(): string;
    public function getDimensions(): DimensionsMm;
}
?>
