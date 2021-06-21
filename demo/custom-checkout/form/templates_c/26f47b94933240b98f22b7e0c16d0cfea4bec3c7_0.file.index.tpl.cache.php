<?php
/* Smarty version 3.1.36, created on 2020-08-25 18:25:59
  from '/opt/lampp/htdocs/netpay-checkout-php/demo/form/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5f453b974dd8b9_29825734',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '26f47b94933240b98f22b7e0c16d0cfea4bec3c7' => 
    array (
      0 => '/opt/lampp/htdocs/netpay-checkout-php/demo/form/templates/index.tpl',
      1 => 1598372757,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5f453b974dd8b9_29825734 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '13152343045f453b9748aac5_45022061';
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
