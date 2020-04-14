<?php

namespace App\Infrastructure\Handler;

use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface HandlerInterface
 * @package App\Infrastructure\Handler
 */
interface HandlerInterface
{
    /**
     * @param Request $request
     * @param object $originalData
     * @param array $options
     * @return bool
     */
    public function handle(Request $request, object $originalData, array $options = []): bool;

    /**
     * @return FormView
     */
    public function createView(): FormView;
}
