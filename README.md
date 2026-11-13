# denosyscore/app

DenoSys application skeleton for bootstrapping a new app with a minimal dependency surface.

## Create a New Project

```bash
composer create-project denosyscore/app my-app
```

## Dependency Model

New projects require PHP 8.4.1 or newer and framework 0.21.0 or newer in the
0.21 release line. Framework defines a tested component distribution, so
projects do not need separate Denosys runtime package constraints.

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
`storage/app/public`, stop writes and back up both locations. If
`public/storage` is a symlink, unlink only the symlink first while preserving
`storage/app/public`; create a real `public/storage` directory, then copy the
old public files into it and verify their hashes. Clear any cached
configuration with `php core config:clear` before resuming writes.

The development router rejects executable extensions and hidden paths under
the web root. In production, configure the web server to deny PHP and other
executable files under `/storage/`, and allow only `public/index.php` to reach
PHP-FPM. Public upload handlers should also restrict file type and extension.

## Mail

The starter app registers `Denosys\Mail\MailServiceProvider`, which binds
Symfony's `MailerInterface` and resolves its transport when first used. Set
`MAIL_MAILER=smtp` with the `MAIL_HOST`, `MAIL_PORT`, `MAIL_ENCRYPTION`,
`MAIL_USERNAME`, and `MAIL_PASSWORD` values needed by your server, or set
`MAIL_MAILER=sendmail` and `MAIL_SENDMAIL_PATH`. For another Symfony-supported
transport, set an explicit `MAIL_DSN`; it takes precedence over `MAIL_MAILER`.
The starter config does not provide Mailgun, log, or in-memory array drivers.
Configure and verify a real transport before sending account mail.
The framework's `make:mail` command now generates Symfony MIME `Email`
messages. Its former `--markdown` option is unsupported. Applications using
generated messages should declare `symfony/mime` directly and send through
the registered `MailerInterface`.

## What You Get

- HTTP and CLI entry points (`public/index.php`, `core`)
- Application bootstrap (`bootstrap/app.php`)
- Base app provider, controller, and user model
- Starter configuration in `config/`
- Starter routes in `routes/web.php`

## Repository Workflows

- `CI`: clean published dependency installs, CLI boot, manifest and syntax checks, and disk/router contracts on PHP 8.4 and 8.5
- `Release`: publish GitHub release on semantic tags
- `Dependabot`: weekly Composer dependency checks
