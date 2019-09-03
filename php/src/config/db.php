<?php
return [
    'class' => 'yii\db\Connection',
    'dsn' => getenv('DB_DSN'),
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASS'),
    'enableSchemaCache' => !YII_DEBUG,
    'schemaCacheDuration' => 360,
    'schemaCache' => 'cache',
];
