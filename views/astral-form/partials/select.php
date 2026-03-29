<?php

declare(strict_types=1);

/**
 * Partial select.
 *
 * Variables attendues :
 * - Astral\Form\FormBuilder $form
 * - string $name
 * - string $label
 * - array<string, string> $choices
 * - mixed $selected
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
echo $form->select(
    name: $name,
    choices: $choices,
    selected: $selected ?? null,
    errors: $errors ?? [],
    options: $options,
);
echo $form->error(
    name: $name,
    errors: $errors ?? [],
);
echo "</div>\n";
