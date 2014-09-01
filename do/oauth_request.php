<?php

/*
echo '<pre>';
var_export( $_POST );
echo '</pre>';
*/

$rightsConfigurator = \YandexMoney\YandexMoney::getRightsConfigurator();

if ( isset( $_POST[ 'scope' ] ) && is_array( $_POST[ 'scope' ] ) ) {
    foreach ( $_POST[ 'scope' ] as $currentRight ) {
        $rightsConfigurator->addRight( $currentRight );
    }
}

$rightsConfigurator->paymentToAccount(
    ( isset( $_SESSION[ 'sellerOptions.client-purse' ] ) ) ? $_SESSION[ 'sellerOptions.client-purse' ] : YM_PURSE,
    \YandexMoney\Presets\PaymentIdentifier::ACCOUNT,
    ( isset( $_POST[ 'scope_days' ] ) ) ? $_POST[ 'scope_days' ] : 1,
    ( isset( $_POST[ 'scope_amount' ] ) ) ? $_POST[ 'scope_amount' ] : 100
);
$rightsConfigurator->setMoneySource( \YandexMoney\Presets\MoneySource::WALLET );

$authRequestBuilder = \YandexMoney\YandexMoney::getAuthRequestBuilder();
$authRequestBuilder->setClientId( ( isset( $_SESSION[ 'sellerOptions.client-id' ] ) ) ? $_SESSION[ 'sellerOptions.client-id' ] : YM_CLIENT_ID );
$authRequestBuilder->setRedirectUri( ( isset( $_SESSION[ 'sellerOptions.response-link' ] ) ) ? $_SESSION[ 'sellerOptions.response-link' ] : YM_RESPONSE_LINK );
$authRequestBuilder->setRights( $rightsConfigurator->toString() );

$apiFacade = \YandexMoney\YandexMoney::getApiFacade();

$originalServerResponse = NULL;
try {
    $originalServerResponse = $apiFacade->authorizeApplication( $authRequestBuilder );
} catch ( \Exception $e ) {
    $oAuthCreate_Error = $e->getMessage();
}

if ( $originalServerResponse ) {
    $oAuthCreate_Link = $originalServerResponse->getHeader( 'Location' );
}