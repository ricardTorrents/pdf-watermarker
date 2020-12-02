<?php
include('../../Domain/Interfaces/IImageWatermark.php');


//position 'center','topright', 'topleft', 'bottomright', 'bottomleft'

/**
 * pdfwatermark.php
 *
 * This class defines properties of a watermark
 * @author Binarystash <binarystash01@gmail.com>
 * @version 1.1.1
 * @license https://opensource.org/licenses/MIT MIT
 */
class PDFWatermark
{

    private IImageWatermark $imageWatermark;
    private $position;
    private $asBackground;

    public function __construct(IImageWatermark $imageWatermark, string $position, bool $asbackground)
    {

        $this->imageWatermark = $imageWatermark;
        $this->position = $position;
        $this->asBackground = $asbackground;
    }

    /** Dejamos este constructor simplemente para dar Semantica a la construccion */
    public static function contructCenterOverlay(IImageWatermark $imageWatermark): PDFWatermark
    {

        return new self($imageWatermark, PositionEnum::CENTER, false);
    }

    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    public function setAsBackground(): void
    {
        $this->asBackground = true;
    }

    public function setAsOverlay(): void
    {
        $this->asBackground = false;
    }


    public function usedAsBackground(): bool
    {
        return $this->asBackground;
    }


    public function getPosition(): string
    {
        return $this->position;
    }

    public function getFilePath(): string
    {
        return $this->imageWatermark->getFilePath();
    }


    public function getMMDimension(): array
    {
        return $this->imageWatermark->getMMDimension();
    }

}

?>
