<?php

declare(strict_types=1);

/**
 * Exemple d'usage dans une vue Astral.
 *
 * Variables requises:
 * - Astral\Form\FormBuilder $form
 * - array<string, list<string>> $errors
 * - array<string, mixed> $old
 * - Core\CsrfGuard $csrf
 */
?>
<form method="POST" action="/login" class="max-w-md space-y-1">
    <?= $csrf->field() ?>

    <?= $form->field(
        name: 'email',
        label: 'Adresse e-mail',
        value: $old['email'] ?? '',
        errors: $errors ?? [],
        options: [
            'type' => 'email',
            'required' => true,
            'autocomplete' => 'email',
            'placeholder' => 'vous@domaine.tld',
        ],
    ) ?>

    <?= $form->field(
        name: 'password',
        label: 'Mot de passe',
        value: '',
        errors: $errors ?? [],
        options: [
            'type' => 'password',
            'required' => true,
            'autocomplete' => 'current-password',
            'placeholder' => '********',
        ],
    ) ?>

    <button
        type="submit"
        class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700"
    >
        Se connecter
    </button>
</form>
