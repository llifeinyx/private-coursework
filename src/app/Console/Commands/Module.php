<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class Module extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {--all : Include all features} {name : The name of the module (please use CamelCase, you also can specify namespace like this: Namespace::Module)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module';

    /**
     * Features
     *
     * @var array
     */
    protected array $features = [
        'model' => [
            'app/{Namespace}Models/{ModuleName}.php' => 'templates::model',
        ],
        'controller' => [
            'app/{Namespace}Http/Controllers/{ModuleName}Controller.php' => 'templates::controller',
        ],
        'request' => [
            'app/{Namespace}Http/Requests/Create{ModuleName}Request.php' => 'templates::create-request',
            'app/{Namespace}Http/Requests/Update{ModuleName}Request.php' => 'templates::update-request',
        ],
        'resource' => [
            'app/{Namespace}Http/Resources/{ModuleName}Resource.php' => 'templates::resource',
            'app/{Namespace}Http/Resources/{ModulesName}ListResource.php' => 'templates::list-resource',
        ],
        'policy' => [
            'app/{Namespace}Policies/{ModuleName}Policy.php' => 'templates::policy',
        ],
        'manager' => [
            'app/{Namespace}Contracts/{ModuleName}Manager.php' => 'templates::manager-contract',
            'app/{Namespace}Services/{ModuleName}Manager.php' => 'templates::manager',
            'app/{Namespace}Facades/{ModulesName}.php' => 'templates::facades',
        ],
        'events' => [
            'app/{Namespace}Events/{ModuleName}WasCreated.php' => 'templates::create-event',
            'app/{Namespace}Events/{ModuleName}WasUpdated.php' => 'templates::update-event',
            'app/{Namespace}Events/{ModuleName}WasDeleted.php' => 'templates::delete-event',
        ],
        'exceptions' => [
            'app/{Namespace}Exceptions/Create{ModuleName}Exception.php' => 'templates::create-exception',
            'app/{Namespace}Exceptions/Update{ModuleName}Exception.php' => 'templates::update-exception',
            'app/{Namespace}Exceptions/Delete{ModuleName}Exception.php' => 'templates::delete-exception',
        ],
        'routes' => [
            'routes/{namespace}api.php' => 'templates::routes',
        ],
    ];

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        app()['view']->prependNamespace('templates', [__DIR__ . '/templates']);

        $moduleName = $this->argument('name');
        $allFeatures = $this->option('all');

        $components = explode('::', $moduleName);
        if (count($components) === 1) {
            $moduleNamespace = Str::plural($moduleName);
        } else {
            $moduleNamespace = array_shift($components);
            $moduleName = array_shift($components);
        }

        $varName = strtolower(substr($moduleName, 0, 1)) . substr($moduleName, 1);

        $affectedFiles = [];

        foreach ($this->features as $feature => $files) {
            if ($allFeatures || $this->confirm(sprintf('Do you wish to include feature `%s`?', $feature))) {
                foreach ($files as $destination => $template) {
                    $fileName = base_path(strtr($destination, [
                        '{ModuleName}' => $moduleName,
                        '{ModulesName}' => Str::plural($moduleName),
                        '{Namespace}' => $moduleNamespace ? ($moduleNamespace . '/') : '',
                        '{namespace}' => $moduleNamespace ? (Str::snake($moduleName, '-') . '/') : '',
                    ]));

                    if (is_file($fileName) && !$this->confirm(sprintf('File `%s` already exists! Overwrite it?', $fileName))) {
                        if (!$this->confirm('Do you want to generate the remaining files?')) {
                            return $this->abort();
                        }
                        continue;
                    }

                    $this->info(sprintf('Writing file `%s` using template `%s`', $fileName, $template));
                    $content = view($template, [
                        'name' => $moduleName,
                        'names' => Str::plural($moduleName),
                        'namespace' => $moduleNamespace ? ($moduleNamespace . '\\') : '',
                        'var' => $varName,
                        'vars' => Str::plural($varName),
                    ])->render();

                    $directoryName = dirname($fileName);
                    if (!is_dir($directoryName) && false === @mkdir($directoryName, 0755, true)) {
                        $this->error(sprintf('Error while making directory `%s`!', $directoryName));
                        $this->abort(1);
                    }

                    if (false === @file_put_contents($fileName, $content)) {
                        $this->error(sprintf('Error while writing file `%s`!', $fileName));
                        $this->abort(1);
                    }

                    $affectedFiles[] = $fileName;
                }
            }
        }

        $this->line('');
        $this->info('Job done.');
        $this->info('The affected files are listed below:');
        $this->line('');

        foreach ($affectedFiles as $file) {
            $this->info($file);
        }

        $this->line('');
        $this->info('Do not forget to register stuff:');
        $this->line('');

        $content = view('templates::reminder', [
            'name' => $moduleName,
            'names' => Str::plural($moduleName),
            'namespace' => $moduleNamespace . '\\',
            'var' => $varName,
            'vars' => Str::plural($varName),
        ])->render();

        $this->line($content);

        $this->line('');
        $this->info('Done!');
        $this->line('');
    }

    /**
     * Terminate the process
     *
     * @param int $exitCode
     */
    protected function abort(int $exitCode = 0): void
    {
        $this->info('Aborting...');
        exit($exitCode);
    }
}
