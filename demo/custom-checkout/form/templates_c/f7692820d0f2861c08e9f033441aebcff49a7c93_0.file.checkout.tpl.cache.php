<?php
/* Smarty version 3.1.36, created on 2020-09-03 22:42:53
  from '/opt/lampp/htdocs/netpay-checkout-php/demo/form/templates/checkout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5f51554d8f54b2_77010580',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f7692820d0f2861c08e9f033441aebcff49a7c93' => 
    array (
      0 => '/opt/lampp/htdocs/netpay-checkout-php/demo/form/templates/checkout.tpl',
      1 => 1598907359,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5f51554d8f54b2_77010580 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '19481487835f51554d46f170_60297001';
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "test.conf", "setup", 0);
?>

<?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('title'=>$_smarty_tpl->tpl_vars['title']->value), 0, false);
?>

<div id="netpay-form"></div>
    <?php echo '<script'; ?>
>  
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
            
    <?php echo '</script'; ?>
>

<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
