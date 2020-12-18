<?php

namespace Watermarker\Domain\Interfaces;

interface Image
{
    public function getFilePath(): string;

    public function getMMDimensions(): array;

}
