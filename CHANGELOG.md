# Changelog

Toutes les modifications notables apportées à `astral-form` sont documentées dans ce fichier.

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
