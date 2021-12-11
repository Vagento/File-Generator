<h1 align="center">Vagento - File Generator</h1>
<p>
  <img alt="Version" src="https://img.shields.io/badge/version-1.0.0-blue.svg?cacheSeconds=2592000" />
  <a href="https://opensource.org/licenses/MIT" target="_blank">
    <img alt="License: MIT" src="https://img.shields.io/badge/License-MIT-yellow.svg" />
  </a>
  <a href="https://twitter.com/WWoshid" target="_blank">
    <img alt="Twitter: WWoshid" src="https://img.shields.io/twitter/follow/WWoshid.svg?style=social" />
  </a>
</p>

> This package adds file generators. It requires the Laravel framework.

## Installation

```sh
composer require vagento/file-generator
```

## Usage

<details>
<summary>
<b>Stub File Generator</b>
</summary>

Create a new class that extends the `\Vagento\FileGenerator\StubFileGenerator` class.<br>
And add the required methods to the class:

```php
use Vagento\FileGenerator\StubFileGenerator;

class MyClass extends StubFileGenerator
{
    // This is the path to the file that will be generated
    public function getPath(): string
    {
        return 'path/to/fileToGenerate.php';    
    }
    
    // This is the path to the stub file
    public function getStubPath(): string
    {
        return __DIR__ . '/stubs/file.blade.php';    
    }
    
    // Optional: This is the data that will always be passed to the stub file
    public function getStubData(): array
    {
        // [Key (string) => Value (mixed)]
        return ['always' => 5];
    }
}
```

Now create a new stub file, which must end with `.blade.php`.<br>
You can use the blade syntax:

```
Filename: file.blade.php
Always: {{ $always }}
Other: {{ $other }}
```

Create a new instance of the class and call the `generate()` method.

```php
$myClass = new MyClass();

// Optional: Add stub data
$myClass->addStubData(['other' => 10]);

// Generate the file
$myClass->generate();
```

which will result in the following file:
```
Filename: file.blade.php
Always: 5
Other: 10
```

The `generate()` method will generate the file and overwrite any existing file.
</details>

## Show your support

Give a ⭐️ if this project helped you!

## 📝 License

Copyright © 2021 [Valentin Wotschel](https://github.com/WalterWoshid).<br />
This project is [MIT](https://opensource.org/licenses/MIT) licensed.