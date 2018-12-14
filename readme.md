# Discussion

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

![Overview explanation of how this package work with image.](example.png)

Discussion is nested discussion with approve/disapprove feature. Discussion inside the discussion, like the above image.

Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require carropublic/discussion
```

The package will automatically register itself.

You can publish the migration with:

```bash
php artisan vendor:publish --provider="CarroPublic\Discussion\DiscussionServiceProvider" --tag="migrations"
```

After the migration has been published you can create the media-table by running the migrations:

```bash
php artisan migrate
```

You can publish the config-file with:

```bash
php artisan vendor:publish --provider="CarroPublic\Discussion\DiscussionServiceProvider" --tag="config"
```

## Usage


### Register the Model

In order to use the discussion, you have to register.

### Create Discussions

### DisApprove Discussion

### Disable Auto Approve

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [author name][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/carropublic/discussion.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/carropublic/discussion.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/carropublic/discussion/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/carropublic/discussion
[link-downloads]: https://packagist.org/packages/carropublic/discussion
[link-author]: https://github.com/carropublic
[link-contributors]: ../../contributors]