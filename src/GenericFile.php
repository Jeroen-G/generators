<?php

namespace JeroenG\Generators;

class GenericFile extends FileGeneratorCommand
{
    protected $name = 'gen:file';

    protected $description = 'Create a generic php file';

    protected $type = 'PHP file';

    protected $stub = 'generic';

    public function handle()
    {
        // The dir is extracted from the input (e.g. app from the given app\User.php).
        $this->dir = dirname($this->argument('name')).'/';

        parent::handle();
    }

    protected function getNameInput()
    {
        return basename($this->argument('name'));
    }
}
