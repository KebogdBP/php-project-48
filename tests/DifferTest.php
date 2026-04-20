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

    private function getExpected(string $filename): string
    {
        return trim(file_get_contents($this->getFixturePath($filename)));
    }

    public function testDefaultWithJsonFiles(): void
    {
        $this->assertEquals(
            $this->getExpected('expected_stylish.txt'),
            genDiff($this->getFixturePath('file1.json'), $this->getFixturePath('file2.json'))
        );
    }

    public function testDefaultWithYamlFiles(): void
    {
        $this->assertEquals(
            $this->getExpected('expected_stylish.txt'),
            genDiff($this->getFixturePath('file1.yml'), $this->getFixturePath('file2.yml'))
        );
    }

    public function testStylishWithJsonFiles(): void
    {
        $this->assertEquals(
            $this->getExpected('expected_stylish.txt'),
            genDiff($this->getFixturePath('file1.json'), $this->getFixturePath('file2.json'), 'stylish')
        );
    }

    public function testStylishWithYamlFiles(): void
    {
        $this->assertEquals(
            $this->getExpected('expected_stylish.txt'),
            genDiff($this->getFixturePath('file1.yml'), $this->getFixturePath('file2.yml'), 'stylish')
        );
    }

    public function testPlainWithJsonFiles(): void
    {
        $this->assertEquals(
            $this->getExpected('expected_plain.txt'),
            genDiff($this->getFixturePath('file1.json'), $this->getFixturePath('file2.json'), 'plain')
        );
    }

    public function testPlainWithYamlFiles(): void
    {
        $this->assertEquals(
            $this->getExpected('expected_plain.txt'),
            genDiff($this->getFixturePath('file1.yml'), $this->getFixturePath('file2.yml'), 'plain')
        );
    }
    public function testJsonWithJsonFiles(): void
    {
        $this->assertEquals(
            $this->getExpected('expected_json.txt'),
            genDiff($this->getFixturePath('file1.json'), $this->getFixturePath('file2.json'), 'json')
        );
    }

    public function testJsonWithYamlFiles(): void
    {
        $this->assertEquals(
            $this->getExpected('expected_json.txt'),
            genDiff($this->getFixturePath('file1.yml'), $this->getFixturePath('file2.yml'), 'json')
        );
    }
}
