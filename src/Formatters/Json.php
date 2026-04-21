<?php

namespace Differ\Formatters\Json;

function format(array $diff): string
{
    $result = json_encode($diff, JSON_UNESCAPED_UNICODE);

    if ($result === false) {
        throw new \Exception("JSON encoding failed");
    }

    return $result;
}
