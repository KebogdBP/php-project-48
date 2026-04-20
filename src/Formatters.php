<?php

namespace Differ\Formatters;

use function Differ\Formatters\Stylish\format as stylishFormat;
use function Differ\Formatters\Plain\format as plainFormat;
use function Differ\Formatters\Json\format as jsonFormat;

function format(array $diff, string $formatName): string
{
    return match ($formatName) {
        'plain'  => plainFormat($diff),
        'json'   => jsonFormat($diff),
        'stylish' => stylishFormat($diff),
        default  => throw new \Exception("Unknown format: {$formatName}"),
    };
}
