<?php
/* Smarty version 3.1.36, created on 2020-09-03 22:50:59
  from '/opt/lampp/htdocs/netpay-checkout-php/demo/form/templates/checkout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5f5157332bc391_95750678',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f7692820d0f2861c08e9f033441aebcff49a7c93' => 
    array (
      0 => '/opt/lampp/htdocs/netpay-checkout-php/demo/form/templates/checkout.tpl',
      1 => 1598907359,
      2 => 'file',
    ),
    'd4afe23f677cd02631ac68013adc7d588f97e652' => 
    array (
      0 => '/opt/lampp/htdocs/netpay-checkout-php/demo/form/templates/header.tpl',
      1 => 1598879460,
      2 => 'file',
    ),
    '253a1cbcb56416b688e953e18ff77ab85cc38326' => 
    array (
      0 => '/opt/lampp/htdocs/netpay-checkout-php/demo/form/templates/footer.tpl',
      1 => 1588684111,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 120,
),true)) {
function content_5f5157332bc391_95750678 (Smarty_Internal_Template $_smarty_tpl) {
?>
<HTML>
<HEAD>
    <TITLE>NetPay Checkout</TITLE>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <script type="text/javascript" src="https://docs.netpay.mx/cdn/v1.3/netpay.min.js"></script>
    <script type="text/javascript" src="jquery-3.5.1.min.js"></script>
</HEAD>
<BODY bgcolor="#ffffff">

<div id="netpay-form"></div>
    <script>  
        NetPay.setApiKey("pk_netpay_YZBmAQnMQhRRpfFGRrRijheWx");
        NetPay.setSandboxMode(true);
        
        function success(e) {
            console.log("Token created successfully");
            console.log(e);
            const obj = JSON.parse(e.message.data);
            console.log(obj); 

            $.post( "http://localhost:8080/netpay-checkout-php/demo/form/checkout.php", { token: obj.token})
                .done(function( data ) {
                    console.log( "response: " + data );
                    var obj =JSON.parse(data);
                    if(obj.status == 'REVIEW') {
                        window.location = obj.redirect;
                    }
            });
        }
        
        function error(e) {
            console.log("Something went wrong!");
            console.log(e);
        }
        
        NetPay.form.generate("netpay-form", success, error, { title: "", submitText: "Pagar" });
            
    </script>

</BODY>
</HTML>
<?php }
}
