<?php

namespace JeroenG\Generators;

use Symfony\Component\Console\Input\InputOption;

class BatchGenerator extends FileGeneratorCommand
{

    protected $name = 'gen:batch';

    public function handle()
    {
        if ($this->option('init')) {
            return $this->makeBatchFile($this->getNameInput());
        }

        $batch = $this->getCollectedInput();

        $batch->each(function ($value, $key) {
            $this->call('gen:file', [
                'name' => $value[1].'/'.$key,
                '--stub' => $value[0],
            ]);
        });
    }

    protected function makeBatchFile($name)
    {
        return $this->call('gen:file', [
            'name' => $name,
            '--stub' => 'batch',
        ]);
    }

    protected function getOptions()
    {
        return [
            ['init', 'i', InputOption::VALUE_NONE, 'Initialise an empty batch config to fill in.'],
        ];
    }

    protected function getCollectedInput()
    {
        return collect($this->files->getRequire(base_path($this->getNameInput())));
    }
}
