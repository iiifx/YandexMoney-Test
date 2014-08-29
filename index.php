<form method="POST" action="/do/oauth_request.php" target="_blank">

    <label for="account-info">
        <input type="checkbox" name="scope[]" value="account-info" id="account-info" /> account-info
    </label>
    <label for="operation-history">
        <input type="checkbox" name="scope[]" value="operation-history" id="operation-history" /> operation-history
    </label>
    <label for="operation-details">
        <input type="checkbox" name="scope[]" value="operation-details" id="operation-details" /> operation-details
    </label>
    <label for="account-info">
        <input type="checkbox" name="scope[]" value="incoming-transfers" id="incoming-transfers" /> incoming-transfers
    </label>
    <label for="payment">
        <input type="checkbox" name="scope[]" value="payment" id="payment" /> payment
    </label>
    <label for="operation-details">
        <input type="checkbox" name="scope[]" value="payment-shop" id="payment-shop" /> payment-shop
    </label>
    <label for="payment-p2p">
        <input type="checkbox" name="scope[]" value="payment-p2p" id="payment-p2p" /> payment-p2p
    </label>
    <label for="money-source">
        <input type="checkbox" name="scope[]" value="money-source" id="money-source" /> money-source
    </label>

    <input type="submit" />
</form>