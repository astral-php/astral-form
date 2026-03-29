<?php

declare(strict_types=1);
?>
<form method="POST" action="/register" class="max-w-lg space-y-1">
    <?= $csrf->field() ?>

    <?= $form->field(
        name: 'name',
        label: 'Nom complet',
        value: $old['name'] ?? '',
        errors: $errors ?? [],
        options: [
            'required' => true,
            'autocomplete' => 'name',
            'placeholder' => 'Alice Martin',
        ],
    ) ?>

    <?= $form->field(
        name: 'email',
        label: 'Adresse e-mail',
        value: $old['email'] ?? '',
        errors: $errors ?? [],
        options: [
            'type' => 'email',
            'required' => true,
            'autocomplete' => 'email',
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
            'autocomplete' => 'new-password',
        ],
    ) ?>

    <?= $form->field(
        name: 'password_confirmation',
        label: 'Confirmation du mot de passe',
        value: '',
        errors: $errors ?? [],
        options: [
            'type' => 'password',
            'required' => true,
            'autocomplete' => 'new-password',
        ],
    ) ?>

    <button
        type="submit"
        class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700"
    >
        Créer le compte
    </button>
</form>
