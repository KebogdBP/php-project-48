<?php

namespace Hexlet\Code;

function parseFile(string $filePath): object
{
    $realPath = realpath($filePath);

    if ($realPath === false) {
        throw new \Exception("File not found: {$filePath}");
    }

    $content = file_get_contents($realPath);
    return json_decode($content);
}
