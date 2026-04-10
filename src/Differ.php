<?php

namespace Differ\Differ;

use function Hexlet\Code\parseFile;
use function Functional\sort;

function genDiff(string $pathToFile1, string $pathToFile2): string
{
    $data1 = get_object_vars(parseFile($pathToFile1));
    $data2 = get_object_vars(parseFile($pathToFile2));

    $allKeys = array_keys(array_merge($data1, $data2));
    $sortedKeys = sort($allKeys, fn($a, $b) => strcmp($a, $b));

    $lines = array_map(function ($key) use ($data1, $data2) {
        $val1 = $data1[$key] ?? null;
        $val2 = $data2[$key] ?? null;

        $toString = fn($val) => is_bool($val) ? ($val ? 'true' : 'false') : (string)$val;

        if (!array_key_exists($key, $data2)) {
            return "  - {$key}: {$toString($val1)}";
        }
        if (!array_key_exists($key, $data1)) {
            return "  + {$key}: {$toString($val2)}";
        }
        if ($val1 === $val2) {
            return "    {$key}: {$toString($val1)}";
        }
        return "  - {$key}: {$toString($val1)}\n  + {$key}: {$toString($val2)}";
    }, $sortedKeys);

    return "{\n" . implode("\n", $lines) . "\n}";
}
