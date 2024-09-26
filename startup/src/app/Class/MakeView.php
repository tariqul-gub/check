<?php

namespace Brl\Startup\app\Class;

use App\Http\Controllers\Controller;

class MakeView
{
    public function getTable()
    {
        return view('startup::test');
    }
}
