<?php

namespace App\Class;

use Illuminate\Support\Facades\File;

class MakeController extends FileConfig
{
    public function __construct($tableName)
    {
        $namespace = config('crd.namespace.controller', 'App\\Http\\Controllers');

        $this->setData($tableName, $namespace);

        if (!$this->make_controller) {
            return 'File creation off';
        }

        $controller_stub = "$this->stub_path/Controller.stub";

        $controllerName = 'CustomController';

        $directory = base_path(str_replace('\\', '/', $namespace));
        $file_name = "{$this->name_pascel}Controller.php";

        $file_path =  "$directory/$file_name";
        if (!File::exists($controller_stub)) {
            return 'Stub file does not exist!';
        }
        $controller_stub_content = File::get($controller_stub);

        $modified_content = str_replace(
            array_keys($this->stub_variable),
            array_values($this->stub_variable),
            $controller_stub_content
        );

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        File::put($file_path, $modified_content);
    }
}
