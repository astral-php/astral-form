<?php

declare(strict_types=1);

namespace Astral\Form\Tests;

use Astral\Form\FormBuilder;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Astral/Form/FormBuilder.php';

final class FormBuilderTest extends TestCase
{
    public function testFieldRendersLabelInputAndError(): void
    {
        $form = new FormBuilder();
        $html = $form->field(
            name: 'email',
            label: 'Adresse e-mail',
            value: 'john@example.test',
            errors: ['email' => ['Adresse invalide.']],
            options: ['type' => 'email', 'required' => true],
        );

        self::assertStringContainsString('label', $html);
        self::assertStringContainsString('type="email"', $html);
        self::assertStringContainsString('john@example.test', $html);
        self::assertStringContainsString('Adresse invalide.', $html);
    }

    public function testInputAddsErrorStateClassWhenFieldHasError(): void
    {
        $form = new FormBuilder();

        $htmlWithError = $form->input(
            type: 'text',
            name: 'name',
            value: 'Jane',
            errors: ['name' => ['Requis']],
        );

        $htmlWithoutError = $form->input(
            type: 'text',
            name: 'name',
            value: 'Jane',
            errors: [],
        );

        self::assertStringContainsString('border-red-300', $htmlWithError);
        self::assertStringContainsString('border-gray-300', $htmlWithoutError);
    }

    public function testSelectMarksSelectedOption(): void
    {
        $form = new FormBuilder();
        $html = $form->select(
            name: 'role',
            choices: ['user' => 'Utilisateur', 'admin' => 'Administrateur'],
            selected: 'admin',
        );

        self::assertStringContainsString('value="admin" selected', $html);
    }

    public function testAttributesSkipsEmptyValues(): void
    {
        $form = new FormBuilder();
        $attrs = $form->attributes([
            'id' => 'email',
            'placeholder' => '',
            'required' => true,
            'aria-label' => null,
        ]);

        self::assertSame('id="email" required', $attrs);
    }
}
