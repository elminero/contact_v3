<?php
// GRANT ALL PRIVILEGES ON yii_contact.* TO 'ian'@'localhost' IDENTIFIED BY 'super1964';


return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=127.0.0.1; dbname=yii_contact',
    'username' => 'ian',
    'password' => 'super1964',
    'charset' => 'utf8',
];


/*

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost:3306;dbname=yii_contact',
    'username' => 'ian',
    'password' => 'super1964',
    'charset' => 'utf8',
];

*/

