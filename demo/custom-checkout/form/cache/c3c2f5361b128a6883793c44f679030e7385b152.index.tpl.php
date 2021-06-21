<?php
/* Smarty version 3.1.36, created on 2021-03-31 18:36:18
  from '/Applications/MAMP/htdocs/netpay-checkout-php/demo/form/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_6064c122c1ffd3_47043583',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bfee5c41f89690f298c52bfb7f8f59bf44e7665e' => 
    array (
      0 => '/Applications/MAMP/htdocs/netpay-checkout-php/demo/form/templates/index.tpl',
      1 => 1598372757,
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
function content_6064c122c1ffd3_47043583 (Smarty_Internal_Template $_smarty_tpl) {
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
