<?php
/* Smarty version 3.1.36, created on 2021-03-31 18:42:20
  from '/Applications/MAMP/htdocs/netpay-checkout-php/demo/form/templates/checkout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_6064c28c52ddf7_24790205',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9c40b33c94fe293f751e8f055d77fff55f443269' => 
    array (
      0 => '/Applications/MAMP/htdocs/netpay-checkout-php/demo/form/templates/checkout.tpl',
      1 => 1607620324,
      2 => 'file',
    ),
    '7e88ca3cabd12e42ceb02aeda992feb8c603d21e' => 
    array (
      0 => '/Applications/MAMP/htdocs/netpay-checkout-php/demo/form/templates/header.tpl',
      1 => 1598879460,
      2 => 'file',
    ),
    '9b877a759b96f7bf8c600c5ede3b8a747b19a982' => 
    array (
      0 => '/Applications/MAMP/htdocs/netpay-checkout-php/demo/form/templates/footer.tpl',
      1 => 1588684111,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 120,
),true)) {
function content_6064c28c52ddf7_24790205 (Smarty_Internal_Template $_smarty_tpl) {
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

            $.post( "http://localhost:8888/netpay-checkout-php/demo/form/checkout.php", { token: obj.token})
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
