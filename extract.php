<?php
$lines = file('resources/views/struktur.blade.php');
$partial = array_slice($lines, 6, 497);
file_put_contents('resources/views/partials/struktur-content.blade.php', implode('', $partial));
echo 'Extracted successfully.';
