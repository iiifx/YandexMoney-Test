<?php

define( 'BASEDIR', realpath( __DIR__ . '/../' ) );

# Подключаем модули Компосера
require_once BASEDIR . 'composer/vendor/autoload.php';

# Подключаем настройки кошелька Яндекс.Деньги
require_once BASEDIR . 'options/seller.php';

echo '<pre>';
var_export( $_POST );




