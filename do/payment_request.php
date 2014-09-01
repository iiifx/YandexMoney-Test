<?php

if ( isset( $_SESSION[ 'token' ] ) && $token = $_SESSION[ 'token' ] ) {
    $p2pPaymentRequest = new \YandexMoney\Request\P2pPaymentRequest();
    $p2pPaymentRequest->setTo( ( isset( $_SESSION[ 'sellerOptions_client-purse' ] ) ) ? $_SESSION[ 'sellerOptions_client-purse' ] : YM_PURSE );
    $p2pPaymentRequest->setCodepro( FALSE );
    $p2pPaymentRequest->setAmount( '0.1' );
    $p2pPaymentRequest->setExpirePeriod( 1 );
    $p2pPaymentRequest->setComment( '###Comment###' );
    $p2pPaymentRequest->setMessage( '###Message###' );
    $p2pPaymentRequest->setLabel( '###Label###' );

    $p2pPaymentRequest->setTestPayment( FALSE );
    $p2pPaymentRequest->setTestCard( '0000111122223333' );
    $p2pPaymentRequest->setTestResult( 'success' );

    $response = NULL;
    try {
        $apiFacade = \YandexMoney\YandexMoney::getApiFacade();
        $response = $apiFacade->requestPaymentP2P( $token, $p2pPaymentRequest );
        $processPaymentByWalletRequest = new \YandexMoney\Request\ProcessPaymentByWalletRequest();
        $processPaymentByWalletRequest->setRequestId( $response->getRequestId() );
        $response = $apiFacade->processPaymentByWallet( $token, $processPaymentByWalletRequest );

        var_export( $response );

    } catch ( \Exception $e ) {
        echo $e->getMessage() . ' |<br>' . PHP_EOL;
    }

    $result = 'Empty result';

    if ( $response != NULL ) {
        $result = ( $response->isSuccess() ) ? $response->getStatus() : $response->getError();
    }

    var_export( $result );
} else {
    echo 'TOKEN missing...';
}