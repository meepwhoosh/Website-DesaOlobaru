<?php
$inputFile = 'public/images/logo-parigi.png';
$outputFile = 'public/images/favicon-square.png';

$img = imagecreatefrompng($inputFile);
if (!$img) {
    die("Failed to load image");
}

$width = imagesx($img);
$height = imagesy($img);

$size = max($width, $height);

// Create a new square transparent image
$squareImg = imagecreatetruecolor($size, $size);
imagesavealpha($squareImg, true);
$transparent = imagecolorallocatealpha($squareImg, 0, 0, 0, 127);
imagefill($squareImg, 0, 0, $transparent);

// Calculate offsets to center the original image
$dst_x = ($size - $width) / 2;
$dst_y = ($size - $height) / 2;

// Copy the original image onto the square one
imagecopy($squareImg, $img, $dst_x, $dst_y, 0, 0, $width, $height);

// Save the new image
imagepng($squareImg, $outputFile);

imagedestroy($img);
imagedestroy($squareImg);

echo "Success: Created $outputFile";
?>
