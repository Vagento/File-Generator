<h1 align="center">Vagento - File Generator</h1>
<p>
  <img alt="Version" src="https://img.shields.io/badge/version-1.0.1-blue.svg?cacheSeconds=2592000" />
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
<b>Stub File Generator - From class</b>
</summary>

1. Create a new **class** which extends the `\Vagento\FileGenerator\AbstractStubFileGenerator` class.<br>
And add the **getter methods** to the class:

```php
use Vagento\FileGenerator\AbstractStubFileGenerator;

class MyFileGenerator extends AbstractStubFileGenerator
{
    // Required: This is the path to the file that will be generated
    public function getPath(): string
    {
        return 'path/to/fileToGenerate.php';    
    }
    
    // Required: This is the path to the stub file
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

2. Create a new **stub file**, which must end with `.blade.php`.<br>
You can use the **blade syntax**:

```
Filename: file.blade.php
Always: {{ $always }}
```

3. Create a new **instance of the class** and call the `generate()` method.<br>
   You can also chain the methods.

```php
$generator = new MyFileGenerator();

// Generate the file
$generator->generate();
```

Which will result in the following file:
```
Filename: file.blade.php
Always: 5
```

The `generate()` method will generate the file and overwrite any existing file.
</details>

<br>

<details>
<summary>
<b>Stub File Generator - From setters</b>
</summary>

1. Create a new **stub file**, which must end with `.blade.php`.<br>
You can use the **blade syntax**:

```
Filename: file.blade.php
Data to add: {{ $dataToAdd }}
```

2. Create a new **instance of the class** and call the `generate()` method.<br>
   You can use the **constructor** or use the **methods** (or **chain** them).

```php
$generator = new \Vagento\FileGenerator\Generators\StubFileGenerator(
    'path/to/fileToGenerate.php', // Path to the file which will be generated
    __DIR__ . '/stubs/file.blade.php', // Path to the stub file
    ['dataToAdd' => 10] // Optional: Data that will be passed to the stub file
);

// Generate the file
$generator->generate();

// OR

$generator = new \Vagento\FileGenerator\Generators\StubFileGenerator();

// Set the path to the file which will be generated
$generator->setPath('path/to/fileToGenerate.php');

// Set the path to the stub file
$generator->setStubPath(__DIR__ . '/stubs/file.blade.php');

// Optional: Add data to the stub file
$generator->addStubData(['dataToAdd', 10]);

// Generate the file
$generator->generate();

// OR

// Chain methods
$generator->setPath('path/to/fileToGenerate.php')
    ->setStubPath(__DIR__ . '/stubs/file.blade.php')
    ->addStubData(['dataToAdd', 10])
    ->generate();
```

Which will result in the following file:

```
Filename: file.blade.php
Data to add: 10
```

The `generate()` method will generate the file and overwrite any existing file.
</details>

## Show your support

Give a ⭐️ if this project helped you!

## 📝 License

Copyright © 2021 [Valentin Wotschel](https://github.com/WalterWoshid).<br />
This project is [MIT](https://opensource.org/licenses/MIT) licensed.