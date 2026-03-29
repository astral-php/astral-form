<?php

declare(strict_types=1);

namespace Astral\Form;

use Core\Container;
use Core\ServiceProviderInterface;
use Core\View;

/**
 * Enregistre les services du composant astral-form.
 */
final class FormServiceProvider implements ServiceProviderInterface
{
    /**
     * @param array<string, mixed> $appConfig
     * @param array<string, mixed> $dbConfig
     */
    public function register(Container $container, array $appConfig, array $dbConfig): void
    {
        $container->singleton(FormBuilder::class, fn() => new FormBuilder());

        /** @var View $view */
        $view = $container->make(View::class);
        $view->share('form', $container->make(FormBuilder::class));
    }
}

