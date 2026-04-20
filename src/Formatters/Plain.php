<?php

namespace Differ\Formatters\Plain;

function toPlainString(mixed $val): string
{
    if (is_bool($val)) {
        return $val ? 'true' : 'false';
    }
    if (is_null($val)) {
        return 'null';
    }
    if (is_object($val) || is_array($val)) {
        return '[complex value]';
    }
    if (is_int($val) || is_float($val)) {
        return (string)$val;
    }
    return "'{$val}'";
}

function formatNode(array $node, string $path): string
{
    $currentPath = $path ? "{$path}.{$node['key']}" : $node['key'];

    return match ($node['type']) {
        'nested' => implode(
            "\n",
            array_filter(
                array_map(fn($n) => formatNode($n, $currentPath), $node['children']),
                fn($line) => $line !== ''
            )
        ),
        'added'     => "Property '{$currentPath}' was added with value: " . toPlainString($node['value']),
        'removed'   => "Property '{$currentPath}' was removed",
        'changed'   => "Property '{$currentPath}' was updated. From "
            . toPlainString($node['oldValue']) . " to " . toPlainString($node['newValue']),
        'unchanged' => '',
        default => '',
    };
}

function format(array $diff): string
{
    $lines = array_filter(
        array_map(fn($node) => formatNode($node, ''), $diff),
        fn($line) => $line !== ''
    );
    return implode("\n", $lines);
}
