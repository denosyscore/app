# Changelog

## Unreleased (proposed v0.5.0)

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
