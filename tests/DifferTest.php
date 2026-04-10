<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    private function getFixturePath(string $filename): string
    {
        return __DIR__ . '/fixtures/' . $filename;
    }

    public function testGenDiffFlatJson(): void
    {
        $file1 = $this->getFixturePath('file1.json');
        $file2 = $this->getFixturePath('file2.json');
        $expected = trim(file_get_contents($this->getFixturePath('expected_flat.txt')));

        $this->assertEquals($expected, genDiff($file1, $file2));
    }
}
