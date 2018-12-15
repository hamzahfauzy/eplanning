<?php
/**
 * The manifest of files that are local to specific environment.
 * This file returns a list of environments that the application
 * may be installed under. The returned data must be in the following
 * format:
 *
 * ```php
 * return [
 *     'environment name' => [
 *         'path' => 'directory storing the local files',
 *         'skipFiles'  => [
 *             // list of files that should only copied once and skipped if they already exist
 *         ],
 *         'setWritable' => [
 *             // list of directories that should be set writable
 *         ],
 *         'setExecutable' => [
 *             // list of files that should be set executable
 *         ],
 *         'setCookieValidationKey' => [
 *             // list of config files that need to be inserted with automatically generated cookie validation keys
 *         ],
 *         'createSymlink' => [
 *             // list of symlinks to be created. Keys are symlinks, and values are the targets.
 *         ],
 *     ],
 * ];
 * ```
 */
return [
    'Development' => [
        'path' => 'dev',
        'setWritable' => [
            'satuanharga/runtime',
            'satuanharga/web/assets',
            'eplanning/runtime',
            'eplanning/web/assets',
            'userlevel/runtime',
            'userlevel/web/assets',
            'referensi/runtime',
            'referensi/web/assets',
            'backend/runtime',
            'backend/web/assets',
            'frontend/runtime',
            'frontend/web/assets',
            'eperencanaan/runtime',
            'eperencanaan/web/assets',

            'backend/models',
            'backend/controllers',
            'backend/views',

            'eperencanaan/models',
            'eperencanaan/controllers',
            'eperencanaan/views',

            'eplanning/models',
            'eplanning/controllers',
            'eplanning/views',

            'frontend/models',
            'frontend/controllers',
            'frontend/views',

            'referensi/models',
            'referensi/controllers',
            'referensi/views',

            'satuanharga/models',
            'satuanharga/controllers',
            'satuanharga/views',

            'userlevel/models',
            'userlevel/controllers',
            'userlevel/views',

            'emusrenbang/models',
            'emusrenbang/controllers',
            'emusrenbang/views',

            'emonev/models',
            'emonev/controllers',
            'emonev/views',

        ],
        'setExecutable' => [
            'yii',
            'yii_test',
        ],
        'setCookieValidationKey' => [
            'satuanharga/config/main-local.php',
            'eplanning/config/main-local.php',
            'userlevel/config/main-local.php',
            'referensi/config/main-local.php',
            'backend/config/main-local.php',
            'frontend/config/main-local.php',
            'eperencanaan/config/main-local.php',
            'emusrenbang/config/main-local.php',
            'emonev/config/main-local.php',
        ],
    ],
    'Production' => [
        'path' => 'prod',
        'setWritable' => [
            'satuanharga/runtime',
            'satuanharga/web/assets',
            'eplanning/runtime',
            'eplanning/web/assets',
            'userlevel/runtime',
            'userlevel/web/assets',
            'referensi/runtime',
            'referensi/web/assets',
            'backend/runtime',
            'backend/web/assets',
            'frontend/runtime',
            'frontend/web/assets',
            'eperencanaan/runtime',
            'eperencanaan/web/assets',
            
            'backend/models',
            'backend/controllers',
            'backend/views',

            'eperencanaan/models',
            'eperencanaan/controllers',
            'eperencanaan/views',

            'eplanning/models',
            'eplanning/controllers',
            'eplanning/views',

            'frontend/models',
            'frontend/controllers',
            'frontend/views',

            'referensi/models',
            'referensi/controllers',
            'referensi/views',

            'satuanharga/models',
            'satuanharga/controllers',
            'satuanharga/views',

            'userlevel/models',
            'userlevel/controllers',
            'userlevel/views',

            'emusrenbang/models',
            'emusrenbang/controllers',
            'emusrenbang/views',

            'emusrenbang/models',
            'emusrenbang/controllers',
            'emusrenbang/views',

            'emonev/models',
            'emonev/controllers',
            'emonev/views',
        ],
        'setExecutable' => [
            'yii',
        ],
        'setCookieValidationKey' => [
            'satuanharga/config/main-local.php',
            'eplanning/config/main-local.php',
            'userlevel/config/main-local.php',
            'referensi/config/main-local.php',
            'backend/config/main-local.php',
            'frontend/config/main-local.php',
            'eperencanaan/config/main-local.php',
            'emusrenbang/config/main-local.php',
            'emonev/config/main-local.php',
        ],
    ],
];
