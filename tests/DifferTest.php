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

    private function getExpected(): string
    {
        return trim(file_get_contents($this->getFixturePath('expected_flat.txt')));
    }

    public function testGenDiffFlatJson(): void
    {
        $file1 = $this->getFixturePath('file1.json');
        $file2 = $this->getFixturePath('file2.json');

        $this->assertEquals($this->getExpected(), genDiff($file1, $file2));
    }

    public function testGenDiffFlatYaml(): void
    {
        $file1 = $this->getFixturePath('file1.yml');
        $file2 = $this->getFixturePath('file2.yml');

        $this->assertEquals($this->getExpected(), genDiff($file1, $file2));
    }

    public function testGenDiffMixed(): void
    {
        $file1 = $this->getFixturePath('file1.json');
        $file2 = $this->getFixturePath('file2.yml');

        $this->assertEquals($this->getExpected(), genDiff($file1, $file2));
    }
}
