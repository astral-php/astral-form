# Changelog

Toutes les modifications notables apportées à `astral-form` sont documentées dans ce fichier.

## [0.1.2] - 2026-08-29

### Changements incompatibles

- PHP minimum porté de 8.0 à **8.1** (`"php": "^8.1"`), aligné sur Astral MVC 1.1.3 (cible 8.1 → 8.5).

### Corrigé

- Suppression du `require` Composer `astral-php/astral` ^1 — le package est autonome (FormBuilder + provider) et utilisable avec **astral-core ^2**.

## [0.1.1] - 2026-04-03

### Corrigé

- Correction d'une erreur d'autoloader dans les namespaces du fichier `composer.json` en réduisant le nombre d'antislashs de 4 à 2 pour les chemins `autoload` et `autoload-dev`.

## [0.1.0] - 2026-03-25

### Ajouté

- Implémentation initiale du `FormBuilder` pour les champs texte, les textarea et les champs de sélection (select).
- Helpers de gestion d'erreur (`hasError`, `firstError`, `error`) compatibles avec `Core\Validator`.
- `FormServiceProvider` avec enregistrement de l'injection de dépendances (DI) et partage global aux vues (`$form`).
- Partials de formulaires réutilisables (`field`, `input-text`, `select`, `textarea`).
- Exemples d'intégration (`login`, `register`, `profile`).
- Tests initiaux (PHPUnit) pour la génération HTML et le comportement des états d'erreur.
