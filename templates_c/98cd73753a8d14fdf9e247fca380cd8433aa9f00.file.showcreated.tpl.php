<?php /* Smarty version Smarty-3.0.8, created on 2011-11-01 16:54:56
         compiled from "/Users/David/Sites/HumanClassroom/templates/showcreated.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15048866984eb024605a0090-57338899%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '98cd73753a8d14fdf9e247fca380cd8433aa9f00' => 
    array (
      0 => '/Users/David/Sites/HumanClassroom/templates/showcreated.tpl',
      1 => 1320166495,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15048866984eb024605a0090-57338899',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
	<div id="text">

<h1>Enviroment Details</h1>
coming soon..
<h1>Agents Details</h1>

 This is your generated scenario.
<br/>
<br/>
 
  <?php  $_smarty_tpl->tpl_vars['agent'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('agents')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['agent']->key => $_smarty_tpl->tpl_vars['agent']->value){
?>
<div class="person" style="min-height:350px">
 <img src="lib/characters/1.png" style="float: right;">
 <?php echo $_smarty_tpl->getVariable('agent')->value->name;?>
 is a <?php  $_smarty_tpl->tpl_vars['prop'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('agent')->value->properties->get_byclass('Agent'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['prop']->key => $_smarty_tpl->tpl_vars['prop']->value){
?> <?php echo $_smarty_tpl->getVariable('prop')->value->term;?>
 <?php }} ?>
 <?php if ($_smarty_tpl->getVariable('agent')->value->properties->get_bymodule('Agent Variables')){?>
  and has the following attributes:<br/>
 	<?php  $_smarty_tpl->tpl_vars['prop'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('agent')->value->properties->get_bymodule('Agent Variables'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['prop']->key => $_smarty_tpl->tpl_vars['prop']->value){
?>
 	*<?php echo $_smarty_tpl->getVariable('prop')->value->term;?>

 	<br/>
 	<?php }} ?>
 <?php }?>
 <br/>
  <?php if ($_smarty_tpl->getVariable('agent')->value->properties->get_bymodule('Environment')){?>
 <?php echo $_smarty_tpl->getVariable('agent')->value->name;?>
 owns the following<br/>
 	<?php  $_smarty_tpl->tpl_vars['prop'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('agent')->value->properties->get_bymodule('Environment'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['prop']->key => $_smarty_tpl->tpl_vars['prop']->value){
?>
 	*<?php echo $_smarty_tpl->getVariable('prop')->value->term;?>

 	<br/>
 	<?php }} ?>
 <?php }?>

</div> 
 
 <br/><br/><br/>
 <?php }} ?>
 
 
 
 <table style="border:1">
 <?php  $_smarty_tpl->tpl_vars['class'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('classes')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['class']->key => $_smarty_tpl->tpl_vars['class']->value){
?>
 <th><?php echo $_smarty_tpl->tpl_vars['class']->value['name'];?>
</th>
 <?php }} ?>
 
 
 
 </table>
 THIS
 <br/><br/>
 NEEDS
 <br/><br/>
 DOING<br/><br/>
 
 <a href="graphical">Run Simulation</a><br/>
<a href="graphical">Run HTML5 Graphical Version (will need chrome..) </a>
</div>