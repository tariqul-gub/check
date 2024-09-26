<?php
return [
    'route_enabled' => true,
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
    'unwanted_tables' => [
        'migrations',
        'sessions',
        'cache',
        'cache_locks',
        'jobs',
        'job_batches',
        'laravel_logger_activity',
        'password_reset_tokens',
    ],
    'unwanted_columns' => [
        'id',
        'email_verified_at',
        'remember_token',
        'created_by',
        // 'updated_by',
        'deleted_by',
        'updated_at',
        'created_at',
        'deleted_at',
    ],
    'boolean_options'   => [
        '' => 'Select',
        '1' => 'Active',
        '0' => 'Inactive',
    ],
];
