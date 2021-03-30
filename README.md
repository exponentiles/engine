# The game logic.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/exponentiles/engine.svg?style=flat-square)](https://packagist.org/packages/exponentiles/engine)
[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/exponentiles/engine/Tests?label=tests)](https://github.com/exponentiles/engine/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/exponentiles/engine.svg?style=flat-square)](https://packagist.org/packages/exponentiles/engine)


The game logic.

## Installation

You can install the package via composer:

```bash
composer require exponentiles/engine
```

## Usage

```php
use Exponentiles\Engine\Engine;

$engine = new Engine();

// Start a new game.
$engine->start();

// Steer/move/slide in direction.
// - Engine::DIRECTION_NORTH
// - Engine::DIRECTION_SOUTH
// - Engine::DIRECTION_EAST
// - Engine::DIRECTION_WEST
$engine->steer(Engine::DIRECTION_SOUTH);

// Add a new random tile.
// - Has 90% chance of a 2
// - Has 10% chance of a 4
$engine->addTile();
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [jstoone](https://github.com/jstoone)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
