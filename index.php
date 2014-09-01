<?php

session_start();


define( 'BASEDIR', __DIR__ . '/' );

$loadList = array (
    BASEDIR . '../composer/vendor/autoload.php',
    BASEDIR . 'options/seller_options.php'
);

foreach ( $loadList as $filePath ) {
    /** @noinspection PhpIncludeInspection */
    require_once( $filePath );
}

if ( isset( $_GET[ 'do' ] ) && ( $do = $_GET[ 'do' ] ) ) {
    str_replace( '..', '.', $do );
    if ( is_file( BASEDIR . "do/{$do}.php" ) ) {
        /** @noinspection PhpIncludeInspection */
        require_once( BASEDIR . "do/{$do}.php" );
    }
}

?>

<style type="text/css">
    * {
        font-family: monospace;
    }
    h4 {
        padding: 3px 0 3px 6px;
        margin: 0;
    }
    #tokenBox, #linkBox {
        border: 1px dashed #eee;
        margin: 10px 10px 0 0;
        padding: 6px;
    }
    #linkBox a {
        margin: 10px;
    }
    #tokenBox input[type="text"] {
        width: 100%;
    }
    #oAuthForm, #optionsForm {
        width: 300px;
        border: 1px solid #eee;
        margin: 10px 10px 0 0;
        padding: 4px;
        float: left;
    }
    #oAuthForm label, #optionsForm label {
        display: block;
        margin: 2px;
        height: 26px;
        line-height: 26px;
        vertical-align: middle;
    }
    #oAuthForm  input[type="text"], #optionsForm input[type="text"] {
        float: right;
    }
    #oAuthForm input[type="submit"], #optionsForm input[type="submit"] {
        float: right;
    }
    #oAuth_go, #oAuth_error {
        text-align: center;
        margin: 8px;
        padding: 6px;
        border: 1px solid #ccc;
        background-color: #eee;
    }
</style>

<div id="linkBox">
    <a href="/">Главная</a>
    <a href="/?do=oauth_response&action=delete_token">Удалить токен</a>
</div>

<div id="tokenBox">
    <h4>Токен oAuth</h4>
    <input type="text" name="token" value="<?php if ( isset( $_SESSION[ 'token' ] ) ) echo $_SESSION[ 'token' ]; ?>" />
</div>

<form method="POST" action="/?do=update_options" id="optionsForm">
    <h4>Данные продавца Yandex.Money:</h4>

    <label for="client-purse">
        client-purse <input type="text" name="sellerOptions_client-purse" value="<?php echo ( isset( $_SESSION[ 'sellerOptions_client-purse' ] ) ) ? $_SESSION[ 'sellerOptions_client-purse' ] : YM_PURSE; ?>" id="client-purse" />
    </label>
    <label for="response-link">
        response-link <input type="text" name="sellerOptions_response-link" value="<?php echo ( isset( $_SESSION[ 'sellerOptions_response-link' ] ) ) ? $_SESSION[ 'sellerOptions_response-link' ] : YM_RESPONSE_LINK; ?>" id="client-purse" />
    </label>
    <label for="client-id">
        client-id <input type="text" name="sellerOptions_client-id" value="<?php echo ( isset( $_SESSION[ 'sellerOptions_client-id' ] ) ) ? $_SESSION[ 'sellerOptions_client-id' ] : YM_CLIENT_ID; ?>" id="client-purse" />
    </label>
    <label for="client-secret">
        client-secret <input type="text" name="sellerOptions_client-secret" value="<?php echo ( isset( $_SESSION[ 'sellerOptions_client-secret' ] ) ) ? $_SESSION[ 'sellerOptions_client-secret' ] : YM_CLIENT_SECRET; ?>" id="client-purse" />
    </label>

    <input type="submit" value="Обновить данные" />
</form>

<form method="POST" action="/?do=oauth_request" id="oAuthForm">
    <h4>Права авторизации oAuth:</h4>

    <label for="account-info">
        <input type="checkbox" name="scope[account-info]" value="account-info" id="account-info" checked /> account-info
    </label>
    <label for="operation-history">
        <input type="checkbox" name="scope[operation-history]" value="operation-history" id="operation-history" checked /> operation-history
    </label>
    <label for="operation-details">
        <input type="checkbox" name="scope[operation-details]" value="operation-details" id="operation-details" checked /> operation-details
    </label>
    <label for="incoming-transfers">
        <input type="checkbox" name="scope[incoming-transfers]" value="incoming-transfers" id="incoming-transfers" /> incoming-transfers
    </label>
    <label for="payment">
        <input type="checkbox" name="scope[payment]" value="payment" id="payment" /> payment
    </label>
    <label for="payment-shop">
        <input type="checkbox" name="scope[payment-shop]" value="payment-shop" id="payment-shop" /> payment-shop
    </label>
    <label for="payment-p2p">
        <input type="checkbox" name="scope[payment-p2p]" value="payment-p2p" id="payment-p2p" /> payment-p2p
    </label>
    <label for="money-source">
        <input type="checkbox" name="scope[money-source]" value="money-source" id="money-source" /> money-source
    </label>

    <label for="scope_amount">
        scope-amount <input type="text" name="scope_amount" value="100" id="scope_amount" />
    </label>
    <label for="scope_days">
        scope-days <input type="text" name="scope_days" value="1" id="scope_days" />
    </label>

    <?php if ( isset( $oAuthCreate_Link ) ) { ?>
        <div id="oAuth_go">
            <a href="<?php echo $oAuthCreate_Link; ?>">>> Перейти к авторизации >></a>
        </div>
    <?php } ?>
    <?php if ( isset( $oAuthCreate_Error ) ) { ?>
        <div id="oAuth_error">
            [ Ошибка: <?php echo $oAuthCreate_Error; ?> ]
        </div>
    <?php } ?>

    <input type="submit" value="Сгенерировать ссылку" />
</form>