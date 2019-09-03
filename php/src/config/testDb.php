<?php
return [
    'class' => 'yii\db\Connection',
    'dsn' => getenv('DB_TEST_DSN'),
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASS'),
    'enableSchemaCache' => false,
    'schemaCacheDuration' => 3600,
    'schemaCache' => 'cache',
];
