<?php

declare(strict_types=1);

/**
 * Partial field générique (proxy vers FormBuilder::field()).
 */

echo $form->field(
    name: $name,
    label: $label,
    value: $value ?? null,
    errors: $errors ?? [],
    options: $options ?? [],
);
