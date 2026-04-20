<?php

namespace Differ\Differ;

use function Hexlet\Code\parseFile;
use function Functional\sort;
use function Differ\Formatters\format;

function buildDiff(object $data1, object $data2): array
{
    $keys1 = array_keys(get_object_vars($data1));
    $keys2 = array_keys(get_object_vars($data2));
    $allKeys = array_unique(array_merge($keys1, $keys2));
    $sorted = sort($allKeys, fn($a, $b) => strcmp($a, $b));

    return array_map(function ($key) use ($data1, $data2) {
        $has1 = property_exists($data1, $key);
        $has2 = property_exists($data2, $key);
        $val1 = $has1 ? $data1->$key : null;
        $val2 = $has2 ? $data2->$key : null;

        if ($has1 && $has2 && is_object($val1) && is_object($val2)) {
            return ['key' => $key, 'type' => 'nested', 'children' => buildDiff($val1, $val2)];
        }
        if (!$has2) {
            return ['key' => $key, 'type' => 'removed', 'value' => $val1];
        }
        if (!$has1) {
            return ['key' => $key, 'type' => 'added', 'value' => $val2];
        }
        if ($val1 === $val2) {
            return ['key' => $key, 'type' => 'unchanged', 'value' => $val1];
        }
        return ['key' => $key, 'type' => 'changed', 'oldValue' => $val1, 'newValue' => $val2];
    }, $sorted);
}

function genDiff(string $pathToFile1, string $pathToFile2, string $formatName = 'stylish'): string
{
    $data1 = parseFile($pathToFile1);
    $data2 = parseFile($pathToFile2);
    $diff = buildDiff($data1, $data2);
    return format($diff, $formatName);
}
