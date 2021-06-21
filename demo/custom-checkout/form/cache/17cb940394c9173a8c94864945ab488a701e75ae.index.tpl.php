<?php
/* Smarty version 3.1.36, created on 2020-08-25 19:17:05
  from '/opt/lampp/htdocs/netpay-checkout-php/demo/form/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5f454791985cd0_56229186',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '26f47b94933240b98f22b7e0c16d0cfea4bec3c7' => 
    array (
      0 => '/opt/lampp/htdocs/netpay-checkout-php/demo/form/templates/index.tpl',
      1 => 1598372757,
      2 => 'file',
    ),
    'd4afe23f677cd02631ac68013adc7d588f97e652' => 
    array (
      0 => '/opt/lampp/htdocs/netpay-checkout-php/demo/form/templates/header.tpl',
      1 => 1598372523,
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
function content_5f454791985cd0_56229186 (Smarty_Internal_Template $_smarty_tpl) {
?>
<HTML>
<HEAD>
    <TITLE>NetPay Checkout</TITLE>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <script type="text/javascript" src="https://docs.netpay.mx/cdn/v1.2/netpay.js"></script>
</HEAD>
<BODY bgcolor="#ffffff">

<div id="netpay-form"></div>
    <script>  
        NetPay.setApiKey("pk_netpay_YZBmAQnMQhRRpfFGRrRijheWx");
        NetPay.setSandboxMode(true);
        
        function success(e) {
            console.log("Token created successfully");
            console.log(e); 
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
