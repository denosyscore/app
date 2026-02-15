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
php -S 127.0.0.1:8000 -t public
```

## What You Get

- HTTP and CLI entry points (`public/index.php`, `core`)
- Application bootstrap (`bootstrap/app.php`)
- Base app provider, controller, and user model
- Starter configuration in `config/`
- Starter routes in `routes/web.php`

## Repository Workflows

- `CI`: composer validation + PHP syntax checks on push/PR
- `Release`: publish GitHub release on semantic tags
- `Dependabot`: weekly Composer dependency checks
