<?php

if ( isset( $_GET[ 'code' ] ) ) {
    $_SESSION[ 'token' ] = $_GET[ 'code' ];
}