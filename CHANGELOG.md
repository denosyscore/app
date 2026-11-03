# Changelog

## v0.2.0

- Map the default public disk directly to its web-served `/storage` URL without
  an unavailable link command. Keep generated public files out of Git.
- Route the development server through a script that blocks executable and
  hidden public paths, and document the equivalent production rule.
- Check the URL-to-root and development-router contracts in CI and permit
  release publication.

Existing applications using `storage/app/public` must copy their public files
to `public/storage` when adopting the new default.
