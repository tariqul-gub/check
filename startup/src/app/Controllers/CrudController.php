<?php

namespace Brl\Startup\app\Controllers;

use App\Http\Controllers\Controller;

class CrudController
{
    public function getTable()
    {
        return view('startup::test');
    }
}
