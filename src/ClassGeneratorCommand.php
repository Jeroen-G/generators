<?php

namespace JeroenG\Generators;

use Illuminate\Console\GeneratorCommand as IlluminateGenerator;

abstract class ClassGeneratorCommand extends IlluminateGenerator
{
    /**
     * The name of the stub file for this class.
     *
     * @var string
     */
    protected $stub;

    /**
     * The optional namespace added to the root namespace.
     * Starting with a trailing slash (\).
     *
     * @var string
     */
    protected $namespace;

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/'.$this->stub.'.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return (isset($this->namespace)) ? $rootNamespace.$this->namespace : $rootNamespace;
    }
}