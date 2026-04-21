<?php

namespace Hexlet\Code;

use Symfony\Component\Yaml\Yaml;

function parseFile(string $filePath): object
{
    $realPath = realpath($filePath);

    if ($realPath === false) {
        throw new \Exception("File not found: {$filePath}");
    }

    $content = file_get_contents($realPath);

    if ($content === false) {
        throw new \Exception("Cannot read file: {$filePath}");
    }

    $extension = pathinfo($realPath, PATHINFO_EXTENSION);

    return match ($extension) {
        'json' => json_decode($content),
        'yml', 'yaml' => Yaml::parse($content, Yaml::PARSE_OBJECT_FOR_MAP),
        default => throw new \Exception("Unsupported format: {$extension}")
    };
}
