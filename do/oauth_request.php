<?php

/*
echo '<pre>';
var_export( $_POST );
echo '</pre>';
*/

$rightsConfigurator = \YandexMoney\YandexMoney::getRightsConfigurator();

$rightsConfigurator->addRight( \YandexMoney\Presets\Rights::ACCOUNT_INFO );
$rightsConfigurator->addRight( \YandexMoney\Presets\Rights::OPERATION_HISTORY );
//$rightsConfigurator->addRight( \YandexMoney\Presets\Rights::OPERATION_DETAILS );
//$rightsConfigurator->addRight( \YandexMoney\Presets\Rights::PAYMENT_P2P );

//$rightsConfigurator->paymentToAccount( $sellerPurse, PaymentIdentifier::ACCOUNT, 1, 10000 );
//$rightsConfigurator->paymentToPattern( "337", 1, 10000 );
//$rightsConfigurator->setMoneySource( MoneySource::WALLET );

$authRequestBuilder = \YandexMoney\YandexMoney::getAuthRequestBuilder();
$authRequestBuilder->setClientId( YM_CLIENT_ID );
$authRequestBuilder->setRedirectUri( YM_RESPONSE_LINK );
$authRequestBuilder->setRights( $rightsConfigurator->toString() );

$apiFacade = \YandexMoney\YandexMoney::getApiFacade();

$originalServerResponse = NULL;
try {
    $originalServerResponse = $apiFacade->authorizeApplication( $authRequestBuilder );
} catch ( \Exception $e ) {
    echo '[Error: ' . $e->getMessage() . ' ]';
}

if ( $originalServerResponse ) {
    echo '<a href="' . $originalServerResponse->getHeader( 'Location' ) . '" target="_blank">Запрос oAuth на Yandex.Money</a>';
}