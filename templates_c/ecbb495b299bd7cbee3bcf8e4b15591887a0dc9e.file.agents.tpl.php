<?php /* Smarty version Smarty-3.0.8, created on 2011-10-28 09:36:53
         compiled from "/Users/David/Sites/HumanClassroom/templates/agents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7338441814eaa69a55dab43-88967383%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ecbb495b299bd7cbee3bcf8e4b15591887a0dc9e' => 
    array (
      0 => '/Users/David/Sites/HumanClassroom/templates/agents.tpl',
      1 => 1312973778,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7338441814eaa69a55dab43-88967383',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
	<div id="text">



<h1>Agents</h1>

 These are your generated agents. Please give them an agent type:
<br/>
<br/>
 
 
 
 <table>


	
	
	<tr style="font-weight:bold;"><td>Agent Name</td><td>Type</td></tr>

 
 <?php  $_smarty_tpl->tpl_vars['agent'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('agents')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['agent']->key => $_smarty_tpl->tpl_vars['agent']->value){
?>

 <tr>
	<td><div id="agent-<?php echo $_smarty_tpl->tpl_vars['agent']->value['agent_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['agent']->value['agent_name'];?>
</div></td>
	<td><div id="agent-<?php echo $_smarty_tpl->tpl_vars['agent']->value['agent_id'];?>
-classag">*unknown*</div></td>

	
	
	<script type="text/javascript">
	
	new Ajax.InPlaceEditor( 'agent-<?php echo $_smarty_tpl->tpl_vars['agent']->value['agent_id'];?>
', 'taxonomy-editinplace.php');
	//pipe this up
	new Ajax.InPlaceCollectionEditor('agent-<?php echo $_smarty_tpl->tpl_vars['agent']->value['agent_id'];?>
-classag', 'taxonomy-editinplace.php', {
	 	collection: [
	  		<?php  $_smarty_tpl->tpl_vars['class'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('agent_types')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['class']->key => $_smarty_tpl->tpl_vars['class']->value){
?>'<?php echo $_smarty_tpl->tpl_vars['class']->value['agent_type'];?>
',<?php }} ?>
	  	]
	  
			});
	
	</script>
	
	
	
</tr>
<?php }} ?>

</table>
<br/><br/>
<a href="?create=generate"> My Agents are done, now generate a scenario! </a>
</div>