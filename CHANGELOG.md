# Changelog

## v0.2.0

- Map the default public disk directly to its web-served `/storage` URL without
  an unavailable link command. Keep generated public files out of Git.
- Check the URL-to-root contract in CI and permit release publication.

Existing applications using `storage/app/public` must copy their public files
to `public/storage` when adopting the new default.
