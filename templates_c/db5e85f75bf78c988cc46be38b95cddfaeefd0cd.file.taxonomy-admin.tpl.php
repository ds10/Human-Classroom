<?php /* Smarty version Smarty-3.0.8, created on 2011-08-11 12:33:10
         compiled from "/Users/David/Sites/LD-creation/templates/taxonomy-admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21389540084e43bdf6b072a6-52540103%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'db5e85f75bf78c988cc46be38b95cddfaeefd0cd' => 
    array (
      0 => '/Users/David/Sites/LD-creation/templates/taxonomy-admin.tpl',
      1 => 1313062257,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21389540084e43bdf6b072a6-52540103',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="text">
<!--  
<h2>ADMIN: Taxonomies</h2>
-->
<br/><br/><br/><br/>
<table width = "100%">
<?php  $_smarty_tpl->tpl_vars['term'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('taxonomies')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['term']->key => $_smarty_tpl->tpl_vars['term']->value){
?>

	<?php if ($_smarty_tpl->tpl_vars['term']->value['module_name']!=$_smarty_tpl->getVariable('previousmodule')->value){?>
<tr><td colspan="3"><h2><?php echo $_smarty_tpl->tpl_vars['term']->value['module_name'];?>
</h2></td></tr>
<tr><td colspan="3"><div><i><?php echo $_smarty_tpl->tpl_vars['term']->value['description'];?>
</i></div></td></tr>

<tr><td colspan="3"><form action="taxonomy.php" method="post">
			Add a new term: <input type="text" id="term_name" name="term_name"/>
			<input type="hidden" name="module_id" id="module_id" value="<?php echo $_smarty_tpl->tpl_vars['term']->value['module_id'];?>
"/>
			<input type="hidden" name="action" id="action" value="new_term"/>
			<input type="submit" label="GO" id="submit"/>
		</form>
		<?php $_smarty_tpl->tpl_vars['previousmodule'] = new Smarty_variable($_smarty_tpl->tpl_vars['term']->value['module_name'], null, null);?>
<br/>
	</td></tr>
	
	<tr style="font-weight:bold;"><td>Term</td><td>Class</td><td>Multiple</td><td>Must Have</td><td>Scalable</td><td>Scale 1 - 100</td></tr>


	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['term']->value['term']){?><?php $_template = new Smarty_Internal_Template("term-admin.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?><?php }?>

	
<?php }} ?>

</table>


<div class="chunk-thin">
	<form action="taxonomy.php" method="post">
		Add a new module:
		<input type="text" name="module_name" id="module_name"/><br/>
		And describe it briefly:
		<textarea name="module_description" id="module_description">Enter some text!</textarea>
		<input type="hidden" name="action" id="action" value="new_module"/>
		<br/>
		<input type="submit" label="GO" id="submit"/>
	</form>
</div>



<script type="text/javascript">
	function setmultiple(termid,value){
		new Ajax.Request('taxonomy-editinplace.php',{parameters:{'action':'edit_term','termid':termid,'property':'multiple','value':value}});
	}

	function setnecessary(termid,value){
		new Ajax.Request('taxonomy-editinplace.php',{parameters:{'action':'edit_term','termid':termid,'property':'necessary','value':value}});
	}

	function setscalable(termid,value){
		new Ajax.Request('taxonomy-editinplace.php',{parameters:{'action':'edit_term','termid':termid,'property':'scalable','value':value}});
	}
</script>


</div>