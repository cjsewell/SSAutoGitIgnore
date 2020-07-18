# Wordpress Auto Git Ignore
A Composer post-update-cmd script to automatically add Composer managed Wordpress plugins and themes to .gitignore  

See [WordPress Packagist](https://wpackagist.org/) for more information about managing Wordpress plugins and themes with Composer

## Installation
### Add it to your project with:
```shell
composer require cjsewell/wp-auto-git-ignore
```
### Add the following to your composer.json
```json
"scripts": {
     "post-update-cmd": "GDM\\WPAutoGitIgnore\\UpdateIgnore::Go"
}
```

## License
3-clause BSD license   
See [License](license.md)

## Bugtracker
Bugs are tracked in the issues section of this repository. Before submitting an issue please read over existing issues to ensure yours is unique.

If the issue does look like a new bug:

 - [Create a new issue](../../issues/new)
 - Describe the steps required to reproduce your issue, and the expected outcome. Unit tests, screenshots and screencasts can help here.
 - Describe your environment as detailed as possible: Browser, Operating System, etc.

## Development and contribution
Feature requests can also be made by [creating a new issue](../../issues/new).  
If you would like to make contributions to this module, feel free to [create a fork](../../fork) and submit a pull request

## Versioning
This project follows [Semantic Versioning](http://semver.org) paradigm. That is:

> Given a version number MAJOR.MINOR.PATCH, increment the:
>  1. MAJOR version when you make incompatible API changes,
>  2. MINOR version when you add functionality in a backwards-compatible manner, and
>  3. PATCH version when you make backwards-compatible bug fixes.
>  4. Additional labels for pre-release and build metadata are available as extensions to the MAJOR.MINOR.PATCH format.
