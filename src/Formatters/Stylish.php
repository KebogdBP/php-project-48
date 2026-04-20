<?php

namespace Differ\Formatters\Stylish;

function valueToString(mixed $val, int $depth): string
{
    if (is_bool($val)) {
        return $val ? 'true' : 'false';
    }
    if (is_null($val)) {
        return 'null';
    }
    if (!is_object($val)) {
        return (string)$val;
    }

    $indent = str_repeat('    ', $depth + 1);
    $closingIndent = str_repeat('    ', $depth);
    $lines = array_map(
        fn($k, $v) => "{$indent}{$k}: " . valueToString($v, $depth + 1),
        array_keys(get_object_vars($val)),
        array_values(get_object_vars($val))
    );
    return "{\n" . implode("\n", $lines) . "\n{$closingIndent}}";
}

function formatNode(array $node, int $depth): string
{
    $indent = str_repeat('    ', $depth);
    $key = $node['key'];

    return match ($node['type']) {
        'nested' => "{$indent}    {$key}: {\n"
            . implode("\n", array_map(fn($n) => formatNode($n, $depth + 1), $node['children']))
            . "\n{$indent}    }",
        'removed'   => "{$indent}  - {$key}: " . valueToString($node['value'], $depth + 1),
        'added'     => "{$indent}  + {$key}: " . valueToString($node['value'], $depth + 1),
        'unchanged' => "{$indent}    {$key}: " . valueToString($node['value'], $depth + 1),
        'changed'   => "{$indent}  - {$key}: " . valueToString($node['oldValue'], $depth + 1)
            . "\n{$indent}  + {$key}: " . valueToString($node['newValue'], $depth + 1),
        default => "{$indent}    {$key}: [unknown]",
    };
}

function format(array $diff): string
{
    $lines = array_map(fn($node) => formatNode($node, 0), $diff);
    return "{\n" . implode("\n", $lines) . "\n}";
}
