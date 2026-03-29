# Changelog

All notable changes to `astral-form` are documented in this file.

## [0.1.0] - 2026-03-25

### Added

- Initial `FormBuilder` implementation for text inputs, textarea and select.
- Error helpers (`hasError`, `firstError`, `error`) compatible with `Core\Validator`.
- `FormServiceProvider` with DI registration and global view share (`$form`).
- Reusable form partials (`field`, `input-text`, `select`, `textarea`).
- Integration examples (`login`, `register`, `profile`).
- Initial PHPUnit tests for HTML generation and error-state behavior.
