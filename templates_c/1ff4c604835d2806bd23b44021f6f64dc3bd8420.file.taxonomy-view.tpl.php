<?php /* Smarty version Smarty-3.0.8, created on 2011-08-08 16:19:51
         compiled from "/Users/David/Sites/LD-creation/templates/taxonomy-view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8500602674e3ffe9753d491-77160587%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1ff4c604835d2806bd23b44021f6f64dc3bd8420' => 
    array (
      0 => '/Users/David/Sites/LD-creation/templates/taxonomy-view.tpl',
      1 => 1312816788,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8500602674e3ffe9753d491-77160587',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h2>Model Taxonomy</h2>

<table>
<?php  $_smarty_tpl->tpl_vars['term'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('taxonomies')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['term']->key => $_smarty_tpl->tpl_vars['term']->value){
?>

	<?php if ($_smarty_tpl->tpl_vars['term']->value['module_name']!=$_smarty_tpl->getVariable('previousmodule')->value){?>
	
        <tr><td colspan="3">	<h3><?php echo $_smarty_tpl->tpl_vars['term']->value['module_name'];?>
</h3></td></tr>
        <tr><td colspan="3"><div><i><?php echo $_smarty_tpl->tpl_vars['term']->value['description'];?>
</i></div></td></tr>
        
    
        <tr style="font-weight:bold;"><td>TERM</td><td>Class</td></tr>
    
        <?php $_smarty_tpl->tpl_vars['previousmodule'] = new Smarty_variable($_smarty_tpl->tpl_vars['term']->value['module_name'], null, null);?>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['term']->value['term']){?>
        
        <tr>
            <td><div id="term-<?php echo $_smarty_tpl->tpl_vars['term']->value['term_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['term']->value['term'];?>
</div></td>
            <td><div id="term-<?php echo $_smarty_tpl->tpl_vars['term']->value['term_id'];?>
-class"><?php if ($_smarty_tpl->tpl_vars['term']->value['class_name']){?><?php echo $_smarty_tpl->tpl_vars['term']->value['class_name'];?>
<?php }else{ ?>*unknown*<?php }?></div></td>	
        
        </tr>
        
        
	<?php }?>

	
<?php }} ?>
</table>
	