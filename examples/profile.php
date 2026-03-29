<?php

declare(strict_types=1);
?>
<form method="POST" action="/profile" class="max-w-xl space-y-1">
    <?= $csrf->field() ?>

    <?= $form->field(
        name: 'name',
        label: 'Nom',
        value: $old['name'] ?? $auth->name(),
        errors: $errors ?? [],
        options: [
            'required' => true,
        ],
    ) ?>

    <?= $form->field(
        name: 'email',
        label: 'Adresse e-mail',
        value: $old['email'] ?? $auth->email(),
        errors: $errors ?? [],
        options: [
            'type' => 'email',
            'required' => true,
            'autocomplete' => 'email',
        ],
    ) ?>

    <?php
    echo $form->label('role', 'Rôle');
    echo $form->select(
        name: 'role',
        choices: [
            'user' => 'Utilisateur',
            'admin' => 'Administrateur',
        ],
        selected: $old['role'] ?? $auth->role(),
        errors: $errors ?? [],
        options: [
            'placeholder' => 'Sélectionner un rôle',
        ],
    );
    echo $form->error('role', $errors ?? []);
    ?>

    <button
        type="submit"
        class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700"
    >
        Enregistrer
    </button>
</form>
