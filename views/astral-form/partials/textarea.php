<?php

declare(strict_types=1);

/**
 * Partial textarea.
 *
 * Variables attendues :
 * - Astral\Form\FormBuilder $form
 * - string $name
 * - string $label
 * - mixed $value
 * - array<string, list<string>> $errors
 * - array<string, mixed> $options
 */

$options = $options ?? [];

echo '<div class="mb-4">' . "\n";
echo $form->label(
    name: $name,
    text: $label,
    options: ['required' => (bool) ($options['required'] ?? false), 'id' => (string) ($options['id'] ?? $name)],
);
echo $form->textarea(
    name: $name,
    value: $value ?? null,
    errors: $errors ?? [],
    options: $options,
);
echo $form->error(
    name: $name,
    errors: $errors ?? [],
);
echo "</div>\n";
