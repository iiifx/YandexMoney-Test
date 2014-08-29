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

//$rightsConfigurator->addRight( \YandexMoney\Presets\Rights::ACCOUNT_INFO );
//$rightsConfigurator->addRight( \YandexMoney\Presets\Rights::OPERATION_HISTORY );
//$rightsConfigurator->addRight( \YandexMoney\Presets\Rights::OPERATION_DETAILS );
//$rightsConfigurator->addRight( \YandexMoney\Presets\Rights::PAYMENT_P2P );

$rightsConfigurator->paymentToAccount( YM_PURSE, \YandexMoney\Presets\PaymentIdentifier::ACCOUNT, 1, 10000 );
$rightsConfigurator->paymentToPattern( "337", 1, 10000 );
$rightsConfigurator->setMoneySource( \YandexMoney\Presets\MoneySource::WALLET );

$authRequestBuilder = \YandexMoney\YandexMoney::getAuthRequestBuilder();
$authRequestBuilder->setClientId( YM_CLIENT_ID );
$authRequestBuilder->setRedirectUri( YM_RESPONSE_LINK );
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