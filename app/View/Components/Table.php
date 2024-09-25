<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public function __construct(public $class = 'table table-hover mb-0', public $id = null)
    {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.table');
    }
}
