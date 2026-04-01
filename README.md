# astral-form

Helpers et partials de formulaires pour Astral MVC.

`astral-form` fournit un `FormBuilder` léger, sans dependance front
supplementaire, pour generer des champs HTML coherents avec Tailwind
et afficher les erreurs issues de `Core\Validator`.

## Compatibilite

- PHP: `^8.0`
- Astral MVC: `^1.1`

## Installation

```bash
composer require astral-php/astral-form
```

Dans `config/dependencies.php`:

```php
use Astral\Form\FormServiceProvider;

return [
    FrameworkServiceProvider::class,
    DatabaseServiceProvider::class,
    AppServiceProvider::class,
    FormServiceProvider::class,
];
```

Le provider enregistre:

- `Astral\Form\FormBuilder` dans le container
- `$form` partage global dans toutes les vues via `View::share()`

## Usage rapide

```php
<?= $form->field(
    name: 'email',
    label: 'Adresse e-mail',
    value: $old['email'] ?? '',
    errors: $errors ?? [],
    options: ['type' => 'email', 'required' => true],
) ?>
```

Avec un select:

```php
<?= $form->select(
    name: 'role',
    choices: ['user' => 'Utilisateur', 'admin' => 'Administrateur'],
    selected: $old['role'] ?? 'user',
    errors: $errors ?? [],
) ?>
<?= $form->error('role', $errors ?? []) ?>
```

## API du FormBuilder

- `field(string $name, string $label, mixed $value = null, array $errors = [], array $options = []): string`
- `input(string $type, string $name, mixed $value = null, array $errors = [], array $options = []): string`
- `textarea(string $name, mixed $value = null, array $errors = [], array $options = []): string`
- `select(string $name, array $choices, mixed $selected = null, array $errors = [], array $options = []): string`
- `label(string $name, string $text, array $options = []): string`
- `error(string $name, array $errors, string $class = '...'): string`
- `hasError(string $name, array $errors): bool`
- `firstError(string $name, array $errors): ?string`
- `attributes(array $attributes): string`

## Partials fournis

Les partials sont proposes dans `views/astral-form/partials/`:

- `field.php`
- `input-text.php`
- `select.php`
- `textarea.php`

## Exemples

Des exemples complets sont disponibles dans `examples/`:

- `login.php`
- `register.php`
- `profile.php`

## Tests

Depuis la racine du projet Astral:

```bash
vendor/bin/phpunit
```

## License

MIT

