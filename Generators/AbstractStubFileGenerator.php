<?php
/** @noinspection PhpUnused */
namespace Vagento\FileGenerator\Generators;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use LogicException;

abstract class AbstractStubFileGenerator
{
    /**
     * Path to the file which will be generated.
     *
     * @var string
     */
    protected string $path = '';

    /**
     * Path to the stub file.
     *
     * @var string
     */
    protected string $stubPath = '';

    /**
     * Stub data for the generation.
     *
     * @var array<string, mixed>
     */
    protected array $stubData = [];

    /**
     * Get the path of the file which will be generated.
     *
     * @return string
     */
    abstract public function getPath(): string;

    /**
     * Get the path to the stub file.
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
     * Set the path of the file which will be generated.
     *
     * @param string $path
     * @return $this
     */
    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Set the path to the stub file.
     *
     * @param string $stubPath
     * @return $this
     */
    public function setStubPath(string $stubPath): self
    {
        $this->stubPath = $stubPath;

        return $this;
    }

    /**
     * Set stub data for the stub generation.
     *
     * @param array $stubData
     * @return $this
     */
    public function setStubData(array $stubData): self
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
    public function addStubData(array $stubData): self
    {
        $this->stubData = array_merge($this->stubData, $stubData);

        return $this;
    }

    /**
     * Generates the file.
     *
     * @return bool|int The function returns the number of bytes that were written to the file, or false on failure.
     */
    public function generate(): bool|int
    {
        // Set values from class if not empty
        if (($path = $this->getPath()) !== '') $this->path = $path;
        if (($stubPath = $this->getStubPath()) !== '') $this->stubPath = $stubPath;

        if ($this->path === '') {
            throw new LogicException('Path is not set.');
        } else if ($this->stubPath === '') {
            throw new LogicException('Stub path is not set.');
        } else if (!str_ends_with($this->stubPath, '.blade.php')) {
            throw new LogicException('Stub file must end with ".blade.php"');
        }

        // Get stub data
        $stubData = array_merge($this->getStubData(), $this->stubData);

        // Get the contents
        $contents = View::file($this->stubPath, $stubData)
            ->render();

        // Write the file
        File::ensureDirectoryExists(dirname($this->path));
        return File::put($this->path, $contents);
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