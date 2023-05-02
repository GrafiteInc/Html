<?php

namespace Grafite\Html\Commands;

use Illuminate\Console\GeneratorCommand;

class BaseCommand extends GeneratorCommand
{
    /**
     * The type of class being generated.
     *
     * @var string|null
     */
    protected $type = null;

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/base.stub';
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
        return $rootNamespace . '\View';
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return ucfirst(trim($this->argument('name'))) . ucfirst($this->type);
    }

    /**
     * Replace other variables.
     *
     * @param string $stub
     * @param array $keys
     * @param array $values
     *
     * @return $this
     */
    protected function replaceOtherVariables(&$stub, $keys, $values)
    {
        $stub = str_replace(
            $keys,
            $values,
            $stub
        );

        return $this;
    }
}
