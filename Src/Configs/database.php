<?php

return [
    'pdo' => [
        'driver'        => 'mysql',
        'host'          => 'localhost',
        'db_name'       => 'bugout',
        'db_username'   => 'root',
        'db_password'   => 'root',
        'default_fetch' => PDO::FETCH_OBJ,
    ],
    'mysqli' => [
        'host'          => 'localhost',
        'db_name'       => 'bugout',
        'db_username'   => 'root',
        'db_password'   => 'root',
        'default_fetch' => MYSQLI_ASSOC,
    ],
];