<?php
/**
 * Use this file to override global defaults.
 *
 * See the individual environment DB configs for specific config information.
 */
if ( $_SERVER['LOGILIM_ENV'] == 'development') {
    return require ('development/db.php');
} else {
    require ('production/db.php');
}/*
 *
return array(
    'development' => array(
        'type'           => 'mysqli',
        'connection'     => array(
            'hostname'       => 'localhost',
            'port'           => '3306',
            'database'       => 'gaggify.me',
            'username'       => 'root',
            'password'       => 'sohail2155',
            'persistent'     => false,
            'compress'       => false,
        ),
        'identifier'   => '`',
        'table_prefix'   => '',
        'charset'        => 'utf8',
        'enable_cache'   => true,
        'profiling'      => false,
    ),

    'production' => array(
        'type'           => 'mysqli',
        'connection'     => array(
            'hostname'       => 'localhost',
            'port'           => '3306',
            'database'       => 'gaggify.me_v1',
            'username'       => 'root',
            'password'       => 'root',
            'persistent'     => false,
            'compress'       => false,
        ),
        'identifier'   => '`',
        'table_prefix'   => '',
        'charset'        => 'utf8',
        'enable_cache'   => true,
        'profiling'      => false,
    ),
);

 */