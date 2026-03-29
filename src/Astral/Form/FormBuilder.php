<?php

declare(strict_types=1);

namespace Astral\Form;

/**
 * Builder HTML minimaliste pour formulaires Astral.
 *
 * Les erreurs doivent suivre la forme:
 *   ['email' => ['Le champ email est obligatoire.']]
 */
final class FormBuilder
{
    /**
     * @param array<string, list<string>> $errors
     * @param array<string, mixed> $options
     */
    public function field(
        string $name,
        string $label,
        mixed $value = null,
        array $errors = [],
        array $options = []
    ): string {
        $id = (string) ($options['id'] ?? $name);

        $html = '<div class="' . $this->escape($this->wrapperClass((string) ($options['wrapper_class'] ?? ''))) . '">' . "\n";
        $html .= $this->label(name: $name, text: $label, options: ['id' => $id, 'required' => (bool) ($options['required'] ?? false)]);

        $type = (string) ($options['type'] ?? 'text');
        if ($type === 'textarea') {
            $html .= $this->textarea(name: $name, value: $value, errors: $errors, options: $options);
        } else {
            $html .= $this->input(type: $type, name: $name, value: $value, errors: $errors, options: $options);
        }

        if (!empty($options['help'])) {
            $html .= '<p class="' . $this->escape((string) ($options['help_class'] ?? 'mt-1 text-xs text-gray-500')) . '">'
                . $this->escape((string) $options['help'])
                . '</p>' . "\n";
        }

        $html .= $this->error($name, $errors, (string) ($options['error_class'] ?? 'mt-1 text-sm text-red-600'));
        $html .= "</div>\n";

        return $html;
    }

    /**
     * @param array<string, list<string>> $errors
     * @param array<string, mixed> $options
     */
    public function input(
        string $type,
        string $name,
        mixed $value = null,
        array $errors = [],
        array $options = []
    ): string {
        $id = (string) ($options['id'] ?? $name);
        $attrs = [
            'id' => $id,
            'type' => $type,
            'name' => $name,
            'value' => $this->normalizeScalar($value),
            'placeholder' => (string) ($options['placeholder'] ?? ''),
            'autocomplete' => (string) ($options['autocomplete'] ?? ''),
            'class' => $this->inputClass($name, $errors, (string) ($options['class'] ?? '')),
        ];

        if (($options['required'] ?? false) === true) {
            $attrs['required'] = 'required';
        }

        if (($options['disabled'] ?? false) === true) {
            $attrs['disabled'] = 'disabled';
        }

        return '<input ' . $this->attributes($attrs) . '>' . "\n";
    }

    /**
     * @param array<string, list<string>> $errors
     * @param array<string, mixed> $options
     */
    public function textarea(
        string $name,
        mixed $value = null,
        array $errors = [],
        array $options = []
    ): string {
        $id = (string) ($options['id'] ?? $name);
        $attrs = [
            'id' => $id,
            'name' => $name,
            'rows' => (string) ($options['rows'] ?? 4),
            'placeholder' => (string) ($options['placeholder'] ?? ''),
            'class' => $this->inputClass($name, $errors, (string) ($options['class'] ?? '')),
        ];

        if (($options['required'] ?? false) === true) {
            $attrs['required'] = 'required';
        }

        return '<textarea ' . $this->attributes($attrs) . '>'
            . $this->escape($this->normalizeScalar($value))
            . '</textarea>' . "\n";
    }

    /**
     * @param array<string, string> $choices
     * @param array<string, list<string>> $errors
     * @param array<string, mixed> $options
     */
    public function select(
        string $name,
        array $choices,
        mixed $selected = null,
        array $errors = [],
        array $options = []
    ): string {
        $id = (string) ($options['id'] ?? $name);
        $attrs = [
            'id' => $id,
            'name' => $name,
            'class' => $this->inputClass($name, $errors, (string) ($options['class'] ?? '')),
        ];

        if (($options['required'] ?? false) === true) {
            $attrs['required'] = 'required';
        }

        $html = '<select ' . $this->attributes($attrs) . '>' . "\n";

        if (isset($options['placeholder']) && $options['placeholder'] !== '') {
            $placeholder = (string) $options['placeholder'];
            $isSelected = $this->normalizeScalar($selected) === '';
            $html .= '<option value=""' . ($isSelected ? ' selected' : '') . '>'
                . $this->escape($placeholder)
                . "</option>\n";
        }

        $selectedValue = $this->normalizeScalar($selected);
        foreach ($choices as $value => $text) {
            $isSelected = $selectedValue === (string) $value;
            $html .= '<option value="' . $this->escape((string) $value) . '"' . ($isSelected ? ' selected' : '') . '>'
                . $this->escape($text)
                . "</option>\n";
        }

        $html .= "</select>\n";

        return $html;
    }

    /**
     * @param array<string, list<string>> $errors
     * @param array<string, mixed> $options
     */
    public function label(string $name, string $text, array $options = []): string
    {
        $id = (string) ($options['id'] ?? $name);
        $required = (bool) ($options['required'] ?? false);
        $class = trim('mb-1 block text-sm font-medium text-gray-700 ' . (string) ($options['class'] ?? ''));

        $html = '<label for="' . $this->escape($id) . '" class="' . $this->escape($class) . '">';
        $html .= $this->escape($text);
        if ($required) {
            $html .= ' <span class="text-red-600">*</span>';
        }
        $html .= "</label>\n";

        return $html;
    }

    /**
     * @param array<string, list<string>> $errors
     */
    public function error(string $name, array $errors, string $class = 'mt-1 text-sm text-red-600'): string
    {
        $message = $this->firstError($name, $errors);
        if ($message === null) {
            return '';
        }

        return '<p class="' . $this->escape($class) . '">' . $this->escape($message) . "</p>\n";
    }

    /**
     * @param array<string, list<string>> $errors
     */
    public function hasError(string $name, array $errors): bool
    {
        return isset($errors[$name]) && $errors[$name] !== [];
    }

    /**
     * @param array<string, list<string>> $errors
     */
    public function firstError(string $name, array $errors): ?string
    {
        return $errors[$name][0] ?? null;
    }

    /**
     * @param array<string, scalar|null> $attributes
     */
    public function attributes(array $attributes): string
    {
        $pairs = [];
        foreach ($attributes as $key => $value) {
            if ($value === null) {
                continue;
            }

            if (is_bool($value)) {
                if ($value) {
                    $pairs[] = $this->escape($key);
                }

                continue;
            }

            $stringValue = trim((string) $value);
            if ($stringValue === '') {
                continue;
            }

            $pairs[] = $this->escape($key) . '="' . $this->escape($stringValue) . '"';
        }

        return implode(' ', $pairs);
    }

    /**
     * @param array<string, list<string>> $errors
     */
    private function inputClass(string $name, array $errors, string $extraClass = ''): string
    {
        $base = 'mt-1 block w-full rounded-lg border px-3 py-2 text-sm '
            . 'focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500';

        $state = $this->hasError($name, $errors)
            ? 'border-red-300 bg-red-50 text-red-900 placeholder-red-300'
            : 'border-gray-300 bg-white text-gray-900 placeholder-gray-400';

        return trim($base . ' ' . $state . ' ' . $extraClass);
    }

    private function wrapperClass(string $extraClass = ''): string
    {
        return trim('mb-4 ' . $extraClass);
    }

    private function normalizeScalar(mixed $value): string
    {
        if ($value === null) {
            return '';
        }

        if (is_bool($value)) {
            return $value ? '1' : '0';
        }

        if (is_scalar($value)) {
            return (string) $value;
        }

        return '';
    }

    private function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}
