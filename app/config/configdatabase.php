<?php
/* Database Configer */
define( 'PDODRIVER', 'mysql:' );
define( 'HOST',      'mvcapp.nt');
define( 'DBNAME',    'storage' );
define( 'USER',      'root');
define( 'PASSWORD',   '');

// Option Array Which Will Work When Instanitate The PDO Object
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    
];


