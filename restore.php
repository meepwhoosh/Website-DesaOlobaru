<?php
$lines = file("C:/Users/ASUS/.gemini/antigravity-ide/brain/6d5a62d3-563d-4a24-9a17-7163239fce04/.system_generated/logs/transcript_full.jsonl");
foreach ($lines as $line) {
    $data = json_decode($line, true);
    if (isset($data["step_index"]) && $data["step_index"] == 33) {
        $content = $data["content"];
        $parts = explode("The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.\n", $content);
        if (count($parts) > 1) {
            $code = $parts[1];
            // Remove the trailing message
            $code = str_replace("\nThe above content shows the entire, complete file contents of the requested file.\n", "", $code);
            $clean = preg_replace("/^[0-9]+: /m", "", $code);
            file_put_contents("resources/views/struktur.blade.php", $clean);
            echo "Restored struktur.blade.php successfully.";
            break;
        }
    }
}
