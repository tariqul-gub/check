<?php

namespace App\Class;

use Illuminate\Support\Facades\File;

class MakeController extends FileConfig
{
    public static function create()
    {
        dd($this);
        $this->table =  'users_detail';

        if (!parent::$is_make) {
            return 'File creation off';
        }

        $controller_stub = parent::$stub_path . "/Controller.stub";

        $controllerName = 'CustomController';
        $namespace = 'App\\Http\\Controllers\\Crd';

        $directory = base_path(str_replace('\\', '/', $namespace));
        $file_name = "{parent::name_pascel}Controller.php";

        $file_path =  "$directory/$file_name";
        if (!File::exists($controller_stub)) {
            return 'Stub file does not exist!';
        }
        $controller_stub_content = File::get($controller_stub);

        $modified_content = str_replace(
            array_keys(parent::$stub_variable),
            array_values(parent::$stub_variable),
            $controller_stub_content
        );

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        File::put($file_path, $modified_content);
        return 'success';
    }
}
