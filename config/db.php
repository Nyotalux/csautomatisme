<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=automatisme',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',

    //  'class' => 'yii\db\Connection',
    // // Pour SQLite, on indique le chemin vers le fichier de la base
    // 'dsn' => 'sqlite:@app/data/automatisme.db', 
    // 'username' => 'root', // Optionnel pour SQLite
    // 'password' => '',     // Optionnel pour SQLite
    // 'charset' => 'utf8',
];
