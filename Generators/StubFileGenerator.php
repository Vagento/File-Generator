<?php
/** @noinspection PhpUnused */
namespace Vagento\FileGenerator\Generators;

class StubFileGenerator extends AbstractStubFileGenerator
{
    /**
     * StubFileGenerator constructor.
     *
     * @param string               $path
     * @param string               $stubPath
     * @param array<string, mixed> $stubData
     */
    public function __construct(string $path = '', string $stubPath = '', array $stubData = [])
    {
        $this->path = $path;
        $this->stubPath = $stubPath;
        $this->stubData = $stubData;
    }

    /**
     * Get the path of the file which will be generated.
     *
     * @return string
     */
    public function getPath(): string
    {
        return '';
    }

    /**
     * Get the path to the stub file.
     *
     * @return string
     */
    public function getStubPath(): string
    {
        return '';
    }
}