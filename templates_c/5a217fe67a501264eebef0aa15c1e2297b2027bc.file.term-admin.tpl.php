<?php /* Smarty version Smarty-3.0.8, created on 2011-10-28 11:48:39
         compiled from "/Users/David/Sites/HumanClassroom/templates/term-admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12837348904eaa8887b72eb4-82523802%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5a217fe67a501264eebef0aa15c1e2297b2027bc' => 
    array (
      0 => '/Users/David/Sites/HumanClassroom/templates/term-admin.tpl',
      1 => 1313062553,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12837348904eaa8887b72eb4-82523802',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<tr>
	<td><div id="term-<?php echo $_smarty_tpl->getVariable('term')->value['term_id'];?>
"><?php echo $_smarty_tpl->getVariable('term')->value['term'];?>
</div></td>
	<td><div id="term-<?php echo $_smarty_tpl->getVariable('term')->value['term_id'];?>
-class"><?php if ($_smarty_tpl->getVariable('term')->value['class_name']){?><?php echo $_smarty_tpl->getVariable('term')->value['class_name'];?>
<?php }else{ ?>*unknown*<?php }?></div></td>
	<td><form id="mul-<?php echo $_smarty_tpl->getVariable('term')->value['term_id'];?>
"><input id="multiple-<?php echo $_smarty_tpl->getVariable('term')->value['term_id'];?>
" type="checkbox" onChange="setmultiple(<?php echo $_smarty_tpl->getVariable('term')->value['term_id'];?>
,$F('multiple-<?php echo $_smarty_tpl->getVariable('term')->value['term_id'];?>
'));" <?php if ($_smarty_tpl->getVariable('term')->value['multiple']==1){?>checked<?php }?>/></form></td>
	<td><form id="br-<?php echo $_smarty_tpl->getVariable('term')->value['term_id'];?>
"><input id="necessary-<?php echo $_smarty_tpl->getVariable('term')->value['term_id'];?>
" type="checkbox" onChange="setnecessary(<?php echo $_smarty_tpl->getVariable('term')->value['term_id'];?>
,$F('necessary-<?php echo $_smarty_tpl->getVariable('term')->value['term_id'];?>
'));"  <?php if ($_smarty_tpl->getVariable('term')->value['necessary']==1){?>checked<?php }?>/></form></td>
	<td><form id="sc-<?php echo $_smarty_tpl->getVariable('term')->value['term_id'];?>
"><input id="scalable-<?php echo $_smarty_tpl->getVariable('term')->value['term_id'];?>
" type="checkbox" onChange="setscalable(<?php echo $_smarty_tpl->getVariable('term')->value['term_id'];?>
,$F('scalable-<?php echo $_smarty_tpl->getVariable('term')->value['term_id'];?>
'));" <?php if ($_smarty_tpl->getVariable('term')->value['scalable']==1){?>checked<?php }?>/></form></td>
	<td><div id="scale-<?php echo $_smarty_tpl->getVariable('term')->value['term_id'];?>
"><?php echo $_smarty_tpl->getVariable('term')->value['scale'];?>
</div></td>
	
	
	<script type="text/javascript">
	
	new Ajax.InPlaceEditor( 'term-<?php echo $_smarty_tpl->getVariable('term')->value['term_id'];?>
', 'taxonomy-editinplace.php');

	new Ajax.InPlaceEditor( 'scale-<?php echo $_smarty_tpl->getVariable('term')->value['term_id'];?>
', 'taxonomy-editinplace.php');
	
	new Ajax.InPlaceCollectionEditor('term-<?php echo $_smarty_tpl->getVariable('term')->value['term_id'];?>
-class', 'taxonomy-editinplace.php', {
 	collection: [
  		<?php  $_smarty_tpl->tpl_vars['class'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('classes')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['class']->key => $_smarty_tpl->tpl_vars['class']->value){
?>'<?php echo $_smarty_tpl->tpl_vars['class']->value['name'];?>
',<?php }} ?>
  	]
  
		});


		
	</script>
	
	
	
</tr>