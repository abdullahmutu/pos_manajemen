<?php
// Simple script to create hutang views directory and files
$viewsPath = __DIR__ . '/resources/views/hutang';

// Create directory if it doesn't exist
if (!is_dir($viewsPath)) {
    mkdir($viewsPath, 0755, true);
}

echo "Directory created at: $viewsPath\n";
echo "Directory exists: " . (is_dir($viewsPath) ? "Yes" : "No") . "\n";

// List files in directory
$files = scandir(__DIR__ . '/resources/views');
echo "Files in views: " . implode(", ", $files) . "\n";
