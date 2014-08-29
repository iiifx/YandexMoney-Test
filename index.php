<?php

session_start();


define( 'BASEDIR', __DIR__ . '/' );

$loadList = array (
    BASEDIR . '../composer/vendor/autoload.php',
    BASEDIR . 'options/seller.php'
);

foreach ( $loadList as $filePath ) {
    /** @noinspection PhpIncludeInspection */
    require_once( $filePath );
}

if ( isset( $_GET[ 'do' ] ) && ( $do = $_GET[ 'do' ] ) ) {
    str_replace( '..', '.', $do );
    /** @noinspection PhpIncludeInspection */
    require_once( BASEDIR . "do/{$do}.php" );
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
    #tokenBox {
        border: 1px dashed #eee;
        margin: 10px;
        padding: 6px;
    }
    #tokenBox input[type="text"] {
        width: 100%;
    }
    #oAuthForm {
        width: 300px;
        border: 1px solid #eee;
        margin: 10px;
        padding: 4px 4px 30px 4px;
    }
    #oAuthForm label {
        display: block;
        margin: 2px;
    }
    #oAuthForm input[type="submit"] {
        float: right;
    }
    #oAuth_go, #oAuth_error {
        text-align: center;
        margin: 8px;
        padding-left: 6px;
        border: 1px solid #eee;
        background-color: #efefef;
    }
</style>

<div id="tokenBox">
    <h4>Токен oAuth</h4>
    <input type="text" name="token" value="<?php if ( isset( $_SESSION[ 'token' ] ) ) echo $_SESSION[ 'token' ]; ?>" />
</div>

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

    <?php if ( isset( $oAuthCreate_Link ) ) { ?>
        <div id="oAuth_go">
            <a href="<?php echo $oAuthCreate_Link; ?>" target="_blank">>> Перейти к авторизации >></a>
        </div>
    <?php } ?>
    <?php if ( isset( $oAuthCreate_Error ) ) { ?>
        <div id="oAuth_error">
            [ Ошибка: <?php echo $oAuthCreate_Error; ?> ]
        </div>
    <?php } ?>

    <input type="submit" value="Сгенерировать ссылку" />
</form>