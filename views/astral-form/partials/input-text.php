<?php

declare(strict_types=1);

/**
 * Partial input text/email/password.
 *
 * Variables attendues :
 * - Astral\Form\FormBuilder $form
 * - string $name
 * - string $label
 * - mixed $value
 * - array<string, list<string>> $errors
 * - array<string, mixed> $options
 */

echo $form->field(
    name: $name,
    label: $label,
    value: $value ?? null,
    errors: $errors ?? [],
    options: array_merge(['type' => 'text'], $options ?? []),
);
