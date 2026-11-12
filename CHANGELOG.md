# Changelog

## v0.14.0 – 2026-11-12

- Require framework 0.16.0, which completes Phase 2 of the redesign: typed
  configuration, a small container, one boot path, lazy listeners and
  attribute commands.
- Remove `app/Console/Kernel.php`: the console kernel is no longer
  subclassed. Commands in `app/Console/Commands` are still discovered, and
  `make:command` generates `#[AsCommand]` classes.

## v0.13.0 – 2026-11-12

- Require framework 0.14.1. `bootstrap/app.php` uses
  `Application::configure(...)->create()` and lists only the application's
  own providers: mail, filesystem and queue are framework defaults now.
- Remove `bootstrap/providers.php`, which the framework no longer reads.

## v0.12.0 – 2026-11-12

- Require framework 0.13.0, whose container injects configuration with
  `#[Config('path')]` and no longer provides `container:warmup` or
  `container:clear`.

## v0.11.0 – 2026-11-12

- Require framework 0.12.0. Configuration is a `Denosys\Config\Repository`
  (from `denosyscore/config`), and services read settings instead of the
  process environment.
- Add `config/logging.php`, which maps `LOG_PATH` to `logging.path`; the
  logger now reads its path from configuration.

## v0.10.0 – 2026-11-12

- Require framework 0.11.1 (0.11.0 resolved its components to 0.10). Service providers now live in the framework:
  `bootstrap/app.php` registers `Denosys\Framework\Providers\MailServiceProvider`,
  `FilesystemServiceProvider` and `QueueServiceProvider`, and
  `AppServiceProvider` implements `Denosys\Framework\Provider`.

## v0.9.0 – 2026-11-12

- Require framework 0.10.0. The framework is now the DenoSys monorepo and
  contains every component, so a new project installs one `denosyscore/*`
  package instead of nineteen.

## v0.8.0 – 2026-11-11

- Require framework 0.9.0, which drops application-specific helpers and the
  Mailgun, GeoIP2, html2text, HttpClient and S3 dependencies, and looks for
  views in `resources/views`.
- `config/app.php` keeps only generic keys (`name`, `key`, `url`, `env`,
  `debug`, `timezone`, `version`); the contact and description keys are gone.
- `config/filesystems.php` keeps the `local`, `public` and `s3` disks; the
  `s3` disk notes that it needs `league/flysystem-aws-s3-v3`.
- CI fails when config gains application-specific keys or disks, or when a
  tracked file contains a word that identifies a known consumer. The
  denylist is stored as SHA-256 hashes.

## v0.7.0 – 2026-11-11

- Require framework 0.8.0, so new projects install the component releases
  with the data-safety and security fixes (Database 0.5, Routing
  0.7.0-alpha.1, View 0.3, HTTP 0.3.3, Cache 0.2.3 and the matching Auth,
  Console, Queue, Session and Validation patches).
- Verify the 0.8 framework series in the runtime install check.

## v0.6.0

- Require framework 0.7.0 so fresh projects install the tested Console 0.4
  distribution and its corrected Symfony MIME mail generator.
- Verify the 0.7 framework series on PHP 8.4 and 8.5 clean installs.
- Document the generator's breaking output and removal of `--markdown`.

## v0.5.0

- Require framework 0.6.0 so new projects install its tested component
  distribution without repeating runtime package constraints.

## v0.4.0

- Register the framework mail provider in new projects so the configured
  Symfony mailer can resolve during application boot.
- Align starter mail configuration with supported SMTP, sendmail, and explicit
  Symfony DSN transports; remove advertised drivers that were not implemented.
- Exercise mailer and DSN resolution on PHP 8.4 and 8.5 in CI.

## v0.3.0

- Require PHP 8.4.1 and framework 0.5.1 or newer in the 0.5 release line for new projects.
- Install published dependencies and boot the CLI in CI on PHP 8.4 and 8.5.

## v0.2.0

- Map the default public disk directly to its web-served `/storage` URL without
  an unavailable link command. Keep generated public files out of Git.
- Route the development server through a script that blocks executable and
  hidden public paths, and document the equivalent production rule.
- Check the URL-to-root and development-router contracts in CI and permit
  release publication.

Existing applications using `storage/app/public` must copy their public files
to `public/storage` when adopting the new default.
