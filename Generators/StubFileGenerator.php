<?php

namespace Vagento\FileGenerator\Generators;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

abstract class StubFileGenerator
{
    /**
     * Stub data for the generation.
     *
     * @var array<string, mixed>
     */
    protected array $stubData = [];

    /**
     * Get the path of the file.
     *
     * @return string
     */
    abstract public function getPath(): string;

    /**
     * Get the path of the stub file.
     *
     * @return string
     */
    abstract public function getStubPath(): string;

    /**
     * Get the data for the stub generation.
     *
     * @return array<string, mixed>
     */
    public function getStubData(): array
    {
        return [];
    }

    /**
     * Set stub data for the stub generation.
     *
     * @param array $stubData
     * @return $this
     */
    public function setStubData(array $stubData): static
    {
        $this->stubData = $stubData;

        return $this;
    }

    /**
     * Add stub data for the stub generation.
     *
     * @param array $stubData
     * @return $this
     */
    public function addStubData(array $stubData): static
    {
        $this->stubData = array_merge($this->stubData, $stubData);

        return $this;
    }

    /**
     * Generates the file.
     *
     * @return $this
     */
    public function generate(): self
    {
        // Get stub data
        $stubData = array_merge($this->getStubData(), $this->stubData);

        // Get the contents
        $contents = View::file($this->getStubPath(), $stubData)
            ->render();

        // Write the file
        File::ensureDirectoryExists(dirname($this->getPath()));
        File::put($this->getPath(), $contents);

        return $this;
    }

    /**
     * Get the content of the file.
     *
     * @return string
     */
    public function getFileContent(): string
    {
        if (!$this->fileExists()) {
            $this->generate();
        }

        return file_get_contents($this->getPath());
    }

    /**
     * Get the content of the file by requiring the file.
     *
     * @return mixed
     */
    public function require(): mixed
    {
        if (!$this->fileExists()) {
            $this->generate();
        }

        return require $this->getPath();
    }

    /**
     * Checks if the file exists.
     *
     * @return bool
     */
    public function fileExists(): bool
    {
        return file_exists($this->getPath());
    }
}