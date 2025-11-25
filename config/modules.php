<?php

return [

    'paths' => [

        /*
        |--------------------------------------------------------------------------
        | Configuration
        |--------------------------------------------------------------------------
        |
        | The path to the module's configuration file.
        |
        */

        'config' => 'config/config.php',

        /*
        |--------------------------------------------------------------------------
        | Migrations
        |--------------------------------------------------------------------------
        |
        | The path to the module's migrations directory. Migrations are used
        | for database schema changes. This will allow the module to register
        | its migrations when runs database commands.
        |
        */

        'migrations' => 'database/migrations',

        /*
        |--------------------------------------------------------------------------
        | JSON Translations
        |--------------------------------------------------------------------------
        |
        | The path to the module's translation files directory (JSON only).
        |
        */

        'json_translations' => 'lang',

        /*
        |--------------------------------------------------------------------------
        | Views
        |--------------------------------------------------------------------------
        |
        | The path to the module's views directory. Views are used for rendering
        | emails, PDFs, or other non-web views.
        |
        */

        'views' => 'resources/views',

        /*
        |--------------------------------------------------------------------------
        | Routes
        |--------------------------------------------------------------------------
        |
        | The path to the module's routes file. This file serves as the
        | single entry point for all routes within the module, including protected,
        | guest, exposed, and test routes.
        |
        */

        'routes' => 'routes/routes.php',

        /*
        |--------------------------------------------------------------------------
        | Console Tasks
        |--------------------------------------------------------------------------
        |
        | The path to the module's console tasks file. This file is used to register
        | scheduled tasks for the module. It defines closures or queued jobs that
        | should run at recurring intervals (e.g., daily, hourly).
        |
        */

        'console_tasks' => 'routes/console.php',

    ]
];
