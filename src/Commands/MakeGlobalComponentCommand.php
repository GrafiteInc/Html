<?php

namespace Grafite\Html\Commands;

class MakeGlobalComponentCommand extends BaseCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:global-component';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new global html component';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'global-component';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/global-component.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\View\Components\Global';
    }
}
