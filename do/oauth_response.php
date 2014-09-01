<?php

if ( isset( $_GET[ 'code' ] ) ) {
    $_SESSION[ 'token' ] = $_GET[ 'code' ];
} elseif ( isset( $_GET[ 'action' ] ) && $_GET[ 'action' ] === 'delete_token' ) {
    unset( $_SESSION[ 'token' ] );
}