<?php

function SvgToPng($svgString) {
    $imagick = new Imagick();
    $imagick->readImageBlob($svgString);
    $imagick->setResolution(300, 300);
    $imagick->setImageFormat('png');
    return $imagick->getImageBlob();
}

function SvgToJpg($svgString) {
    $imagick = new Imagick();
    $imagick->readImageBlob($svgString);
    $imagick->setResolution(300, 300);
    $imagick->setImageFormat('jpg');
    return $imagick->getImageBlob();
}

function SvgToJpeg($svgString) {
    $imagick = new Imagick();
    $imagick->readImageBlob($svgString);
    $imagick->setResolution(300, 300);
    $imagick->setImageFormat('jpeg');
    return $imagick->getImageBlob();
}

function SvgToWebp($svgString) {
    $imagick = new Imagick();
    $imagick->readImageBlob($svgString);
    $imagick->setResolution(300, 300);
    $imagick->setImageFormat('webp');
    return $imagick->getImageBlob();
}

?>
