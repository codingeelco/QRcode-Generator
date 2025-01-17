<?php
require 'vendor/autoload.php';

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

// Retrieve the parameters from the URL
$size = $_GET['size'] ?? 400; // Default size 400 if not provided
$type = $_GET['type'] ?? 'text'; // Default to 'text' if type is not specified
$value = $_GET['value'] ?? ''; // The content of the QR code (defaults to empty)

// Set the data based on the type
if ($type === 'url') {
    $data = $value ?: 'https://example.com'; // QR code for URL (default to example URL)
} elseif ($type === 'email') {
    $data = $value ?: 'mailto:someone@example.com'; // QR code for email (default to example email)
} elseif ($type === 'phone') {
    $data = $value ?: 'tel:+1234567890'; // QR code for phone number (default to example phone number)
} elseif ($type === 'sms') {
    $data = $value ?: 'sms:+1234567890?body=Hello'; // QR code for SMS (default to example SMS)
} else {
    $data = $value ?: 'Hello World!'; // Default text QR code (default to 'Hello World!')
}

// Set renderer style with size and black color for foreground
$rendererStyle = new RendererStyle($size);

$renderer = new ImageRenderer(
    $rendererStyle,
    new ImagickImageBackEnd() // Using Imagick for image rendering
);

$writer = new Writer($renderer);

// Output directly to the browser
header('Content-Type: image/png');
echo $writer->writeString($data); // Now we only pass the data
exit;
