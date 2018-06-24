# Foundation

Simple PHP5 Framework.

** Table of Contents **

1. [Features](#features)
  * [Cache](#cache)
  * [Crypt](#crypt)
  * [Daemon](#daemon)
  * [Debug](#debug)
  * [Exception](#exception)
  * [File](#file)
  * [Form](#form)
  * [GD](#gd)
  * [Loader](#loader)
  * [Log](#log)
  * [Protocol](#protocol)
  * [Session](#session)
  * [Stdlib](#stdlib)
  * [Type](#type)
  * [Weather](weather)
2. [Setup](#setup)
3. [Documentation](#documentation)
4. [Test](#test)
5. [Contributing](#contributing)
6. [License](#license)

## 1. Features

I wrote and I use this framework for my own projects. All the modules are abstract layers that offer useful functionalities I needed.
Unfortunately I do not provide exhaustive documentation. Please read the code and the comments.

Here the modules:

### Cache

Cache storage interface using array or APC.

### Crypt

Encrypt and decrypt tool using Mcrypt extension and Rijndael and TripleDES cyphers (for the moment)

### Daemon

Work in progress.

### Debug

This module contains classes that implements usefull methods for debugging and benchmarking. It use google chart to render few charts.

### Exception

Foundation exception classes.

### File

This module contains a class that offer a high-level object oriented interface to information and manipulation for an individual directory.

### Form

This module contains a usefull class for form validation.

### GD

This module contains classes that implements usefull methods for image manipulation.

### Loader

This module contains a class that may register with the spl_autoload registry.

### Log

This module contains a logger.

### Protocol

This module contains:

* a download manager.
* an utility to manage client IP address.

### Session

This module contains classes that implements usefull methods to secure a session, like CSRF.

### Stdlib

This module contains an utility class for handling $_SERVER data.

### Type

This module contains classes that allow a Type Declarations implementations. (Simple, Enum and Complex types)

### Weather

This module contains classes that implements usefull methods to:

* read weather data from a file (Weather Underground,YR.no)
* convert wind speed units.

## 2. Setup

Developed on Windows 7 and requires PHP 5.5.37, APC User Cache 4.0.11, PHPUnit 3.7.38, [composer](https://getcomposer.org/).

Check if your PHP and extension versions match the platform requirements.

```batchfile
C:\Foundation>php composer.phar diagnose

and

C:\Foundation>php composer.phar check-platform-reqs
```

Install the required applications:

```batchfile

No dev:

C:\Foundation>php composer.phar install --no-dev

or for dev:

C:\Foundation>php composer.phar install
```

## 3. Documentation

Unfortunately I do not provide exhaustive documentation. Please read the code and the comments.

You can generate documentation using phpdocumentor. It should be installed with [composer](https://getcomposer.org/).

```batchfile
C:\Foundation>./vendor/bin/phpdoc.bat -d src/Foundation -t docs/
```

## 4. Test

Use PHPUnit. Each module has is own config.xml file. Go to tests/scripts and launch cmd files.

## 5. Contributing

Thanks you for taking the time to contribute. Please fork the repository and make changes as you'd like.

As I use this framework for my own projects, it contains only the features I need. But If you have any ideas, just open an [issue](https://github.com/ojullien/foundation/issues/new) and tell me what you think. Pull requests are also warmly welcome.

If you encounter any **bugs**, please open an [issue](https://github.com/ojullien/foundation/issues/new).

Be sure to include a title and clear description,as much relevant information as possible, and a code sample or an executable test case demonstrating the expected behavior that is not occurring.

## 6. License

This project is open-source and is licensed under the [MIT License](https://github.com/ojullien/foundation/blob/master/LICENSE).
