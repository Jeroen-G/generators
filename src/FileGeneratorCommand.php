<?php

namespace JeroenG\Generators;

use Illuminate\Console\GeneratorCommand as IlluminateGenerator;
use Symfony\Component\Console\Input\InputOption;

abstract class FileGeneratorCommand extends IlluminateGenerator
{
    /**
     * The name of the stub file for this class.
     *
     * @var string
     */
    protected $stub;

    /**
     * The optional namespace added to the root namespace.
     * Starting with a \
     *
     * @var string
     */
    protected $namespace;

    /**
     * The directory where the file will be created.
     * Ending with a /
     *
     * @var string
     */
    protected $dir;

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        $name = $this->getNameInput();

        $path = $this->getPath($name);

        // First we will check to see if the class already exists. If it does, we don't want
        // to create the class and overwrite the user's code. So, we will bail out so the
        // code is untouched. Otherwise, we will continue generating this class' files.
        if ((!$this->hasOption('force') ||
            !$this->option('force')) &&
            $this->alreadyExists($this->getNameInput())) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($path);

        $this->files->put($path, $this->files->get($this->getStub()));

        $this->info($this->type . ' created successfully.');
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        return base_path($this->dir) . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = ($this->option('stub')) ? $this->option('stub') : $this->stub;

        return __DIR__ . '/stubs/'.$stub.'.stub';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['stub', 's', InputOption::VALUE_NONE, 'The stub file to use.'],
        ];
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

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        return $this->files->exists($this->getPath($rawName));
    }
}