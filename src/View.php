<?php

namespace JeroenG\Generators;

class View extends FileGeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'gen:view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new view file with basic Blade scaffolding';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Blade view';

    /**
     * The name of the stub file for this class.
     */
    protected $stub = 'view.blade';

    /**
     * The directory for this file.
     *
     * @var string
     */
    protected $dir = 'resources/views/';

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        return base_path($this->dir) . str_replace('\\', '/', $name) . '.blade.php';
    }
}
