<?php

if ( $_POST ) {
    if ( isset( $_POST[ 'sellerOptions_client-purse' ] ) && $_POST[ 'sellerOptions_client-purse' ] ) {
        $_SESSION[ 'sellerOptions_client-purse' ] = $_POST[ 'sellerOptions_client-purse' ];
    }
    if ( isset( $_POST[ 'sellerOptions_response-link' ] ) && $_POST[ 'sellerOptions_response-link' ] ) {
        $_SESSION[ 'sellerOptions_response-link' ] = $_POST[ 'sellerOptions_response-link' ];
    }
    if ( isset( $_POST[ 'sellerOptions_client-id' ] ) && $_POST[ 'sellerOptions_client-id' ] ) {
        $_SESSION[ 'sellerOptions_client-id' ] = $_POST[ 'sellerOptions_client-id' ];
    }
    if ( isset( $_POST[ 'sellerOptions_client-secret' ] ) && $_POST[ 'sellerOptions_client-secret' ] ) {
        $_SESSION[ 'sellerOptions_client-secret' ] = $_POST[ 'sellerOptions_client-secret' ];
    }
}