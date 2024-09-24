<?php

namespace App\Class;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FileConfig
{
    protected $stub_path;
    protected $name_pascel;
    protected $name_snake;
    protected $name_kebab;
    protected $name_camel;
    protected $name_title;
    protected $name_ucfirst;
    protected $name_plural_lowercase;
    protected $name_singular_lowercase;
    protected $stub_variable;
    protected $namespace;
    protected $make_controller;
    protected $make_model;
    protected $table;

    protected function setData($table,  $namespace)
    {
        $this->namespace = $namespace;
        $this->table = $table;
        $this->name_plural_lowercase = Str::plural(strtolower($this->table));
        $this->name_singular_lowercase = Str::singular(strtolower($this->table));
        $this->stub_path = config('crd.stub_path', resource_path('stubs'));
        $this->name_pascel = Str::studly($this->name_singular_lowercase);
        $this->name_snake = Str::snake($this->name_singular_lowercase);
        $this->name_kebab = Str::kebab($this->name_singular_lowercase);
        $this->name_camel = Str::camel($this->name_singular_lowercase);
        $this->name_title = Str::title($this->name_singular_lowercase);
        $this->name_ucfirst = Str::ucfirst($this->name_singular_lowercase);


        $this->stub_variable = [
            '{{namespace}}' => $this->namespace,
            '{{name_pascel}}' => $this->name_pascel,
            '{{name_snake}}' => $this->name_snake,
            '{{name_kebab}}' => $this->name_kebab,
            '{{name_camel}}' => $this->name_camel,
            '{{name_title}}' => $this->name_title,
            '{{name_ucfirst}}' => $this->name_ucfirst,
            '{{name_plural_lowercase}}' => $this->name_plural_lowercase,
            '{{name_singular_lowercase}}' => $this->name_singular_lowercase,
        ];

        $this->make_controller = config('crd.file_create.controller', true);
        $this->make_model = config('crd.file_create.model', true);
    }
}
