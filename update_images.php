<?php

$imageMap = [
    // BPD
    'DRS. SUHARWAN' => 'images/perangkat/BPD/Suharwan .jpeg',
    'NOVI FRANGKI' => 'images/perangkat/BPD/Novi-franki .jpeg',
    'ARIS ANDI LOLO' => 'images/perangkat/BPD/Aris-andi-lolo.jpeg',
    
    // Perangkat Desa
    'ARNOLD' => 'images/perangkat/Perangkat-kantor-desa/Arnold.jpeg',
    'NOLDY RAMBI' => 'images/perangkat/Perangkat-kantor-desa/Noldy-Rambi.jpeg',
    'JEFRI TOPAN TULAK' => 'images/perangkat/Perangkat-kantor-desa/Jefri-Topan-Tulak.jpeg',
    'YULIUS, SE' => 'images/perangkat/Perangkat-kantor-desa/Yulius.jpeg',
    'MASRI JONO' => 'images/perangkat/Perangkat-kantor-desa/Masri-Jono.jpeg',
    'ELDHA' => 'images/perangkat/Perangkat-kantor-desa/Eldha.jpeg',
    'DESMON PALARI' => 'images/perangkat/Perangkat-kantor-desa/Desmon-Palari.jpeg',
    'RESMINA MANGA' => 'images/perangkat/Perangkat-kantor-desa/Resmina-Manga.jpeg',
    'YANCE PESIK' => 'images/perangkat/Perangkat-kantor-desa/Yance-Pesik.jpeg',
    'ROBIN TOBUBU' => 'images/perangkat/Perangkat-kantor-desa/Robin-Tobubu.jpeg',
    'ASGAR KOKOU' => 'images/perangkat/Perangkat-kantor-desa/Asgar-Kokou .jpeg',
];

function updateSeeder($file, $imageMap) {
    $content = file_get_contents($file);
    
    $lines = explode("\n", $content);
    $currentName = null;
    
    foreach ($lines as $i => &$line) {
        if (preg_match('/\'nama\'\s*=>\s*\'(.*?)\'/', $line, $matches)) {
            $currentName = trim($matches[1]);
        }
        
        if ($currentName && preg_match('/\'gambar\'\s*=>/', $line)) {
            if (isset($imageMap[$currentName])) {
                $line = preg_replace('/\'gambar\'\s*=>\s*.*?,/', '\'gambar\' => \'' . $imageMap[$currentName] . '\',', $line);
            }
            $currentName = null; // Reset for next person
        }
    }
    
    file_put_contents($file, implode("\n", $lines));
}

updateSeeder('database/seeders/PerangkatDesaSeeder.php', $imageMap);
updateSeeder('database/seeders/BpdSeeder.php', $imageMap);

echo 'Images mapped successfully.';
