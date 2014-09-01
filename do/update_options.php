<?php

if ( $_POST ) {
    if ( isset( $_POST[ 'sellerOptions.client-purse' ] ) && $_POST[ 'sellerOptions.client-purse' ] ) {
        $_SESSION[ 'sellerOptions.client-purse' ] = $_POST[ 'sellerOptions.client-purse' ];
    }
    if ( isset( $_POST[ 'sellerOptions.response-link' ] ) && $_POST[ 'sellerOptions.response-link' ] ) {
        $_SESSION[ 'sellerOptions.response-link' ] = $_POST[ 'sellerOptions.response-link' ];
    }
    if ( isset( $_POST[ 'sellerOptions.client-id' ] ) && $_POST[ 'sellerOptions.client-id' ] ) {
        $_SESSION[ 'sellerOptions.client-id' ] = $_POST[ 'sellerOptions.client-id' ];
    }
    if ( isset( $_POST[ 'sellerOptions.client-secret' ] ) && $_POST[ 'sellerOptions.client-secret' ] ) {
        $_SESSION[ 'sellerOptions.client-secret' ] = $_POST[ 'sellerOptions.client-secret' ];
    }

    echo '<pre>';
    var_export( $_POST );
    var_export( $_SESSION );
    echo '</pre>';

}