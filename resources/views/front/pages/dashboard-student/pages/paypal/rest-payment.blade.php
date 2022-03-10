<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paypal Payment</title>
</head>
<body>
    <h3>Processing...</h3>
    <!-- paypal integration -->
    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="frmTransaction" id="frmTransaction">
        <input type="hidden" name="business" value="sb-4hkdh697032@business.example.com"> 
        <input type="hidden" name="cmd" value="_xclick"> 
        <input type="hidden" name="item_name" value="item"> 
        <input type="hidden" name="item_number" value="{{ base64_decode($id) }}">
        <input type="hidden" name="amount" value="{{ base64_decode($pay_price) }}">   
        <input type="hidden" name="currency_code" value="USD">   
        <input type="hidden" name="cancel_return" value="{{ route('satirtha.rest-paypal-payment-error-processing') }}"> 
        <input type="hidden" name="return" value="{{ route('satirtha.rest-paypal-payment-success-processing',['id'=>$id]) }}">
    </form>
    <!-- /paypal integration -->
    <script type="text/javascript">document.frmTransaction.submit();</script>
</body>
</html>