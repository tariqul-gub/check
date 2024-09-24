<?php
return [
    'stub_path' => resource_path('stubs'),
    'namespace' => [
        'controller' => 'App\Http\Controllers\Crd',
    ],
    'view' => [
        'path' => 'crd',
    ],

    'file_create' => [
        'controller' => false,
        'model' => true,
        'index' => true,
        'create' => true,
        'form' => true,
        'show' => true,
        'edit' => true,
    ],
];
