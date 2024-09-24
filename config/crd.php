<?php
return [
    'stub_path' => resource_path('stubs'),
    'namespace' => [
        'controller' => 'App\Http\Controllers\Crd',
        'model' => 'App\Models',
    ],
    'view' => [
        'path' => 'crd',
    ],

    'file_create' => [
        'controller' => true,
        'model' => true,
        'index' => true,
        'create' => true,
        'form' => true,
        'show' => true,
        'edit' => true,
    ],
];
