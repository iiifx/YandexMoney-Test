<?php

echo 1;

define( 'BASEDIR', realpath( __DIR__ . '/../' ) );

echo 2;

# Подключаем модули Компосера
require_once BASEDIR . 'composer/vendor/autoload.php';

echo 3;

# Подключаем настройки кошелька Яндекс.Деньги
require_once BASEDIR . 'options/seller.php';

echo 4;

echo '<pre>';
var_export( $_POST );

echo 5;


