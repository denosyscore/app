# denosyscore/app

DenoSys application skeleton for bootstrapping a new app with a minimal dependency surface.

## Create a New Project

```bash
composer create-project denosyscore/app my-app
```

## Dependency Model

The root app `composer.json` keeps dependencies minimal:

- `denosyscore/framework` as the single framework dependency
- all runtime framework components are installed transitively via `denosyscore/framework`

## After Install

```bash
cd my-app
php core optimize
php -S 127.0.0.1:8000 -t public dev-server.php
```

The public disk writes to `public/storage` and returns `/storage` URLs. Make
that directory writable by the web process. Private files belong in a separate
disk rooted outside `public/`. If upgrading an existing application that used
`storage/app/public`, copy its public files into `public/storage` before
switching to this default.

The development router rejects executable extensions and hidden paths under
the web root. In production, configure the web server to deny PHP and other
executable files under `/storage/`, and allow only `public/index.php` to reach
PHP-FPM. Public upload handlers should also restrict file type and extension.

## What You Get

- HTTP and CLI entry points (`public/index.php`, `core`)
- Application bootstrap (`bootstrap/app.php`)
- Base app provider, controller, and user model
- Starter configuration in `config/`
- Starter routes in `routes/web.php`

## Repository Workflows

- `CI`: composer validation, PHP syntax checks, and public disk URL contract on push/PR
- `Release`: publish GitHub release on semantic tags
- `Dependabot`: weekly Composer dependency checks
