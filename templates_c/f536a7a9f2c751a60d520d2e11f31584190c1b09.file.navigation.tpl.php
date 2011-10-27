<?php /* Smarty version Smarty-3.0.8, created on 2011-06-16 16:28:02
         compiled from "/Users/David/Sites/LD-creation/templates/navigation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1573309544dfa2102ecc413-07610517%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f536a7a9f2c751a60d520d2e11f31584190c1b09' => 
    array (
      0 => '/Users/David/Sites/LD-creation/templates/navigation.tpl',
      1 => 1307435995,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1573309544dfa2102ecc413-07610517',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="orangestrip"></div>

<div id="header">


	<div id="logofull">
		<a href="http://jisc.cetis.ac.uk"><img src="http://jisc.cetis.ac.uk/common/images/logofull.png" alt="JISC CETIS"/></a>
	</div>
	

	<div id="navigation">
		<?php $_template = new Smarty_Internal_Template("login-small.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	</div>
</div>


<div id="prod-navigation">
<div>
<?php if ($_smarty_tpl->getVariable('env_self')->value!="/index.php"){?>
	<ul class="tabs">
		<li class= "button"><a href="/">Home</a></li>
		<li class= "button"><a href="/browse/">Browse</a></li>
		<?php if ($_smarty_tpl->getVariable('user')->value->amistaff()){?><li><a href="/admin/">Administer</a></li><?php }?>
	</ul>
<?php }else{ ?>
	<?php if ($_smarty_tpl->getVariable('user')->value->amistaff()){?>
		<ul class="tabs"><li><a href="/admin/">Administer</a></li></ul>
	<?php }?>
<?php }?>
</div>
<?php if ($_smarty_tpl->getVariable('env_self')->value!="/index.php"){?><?php $_template = new Smarty_Internal_Template("search.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?><?php }?>
		
</div>

<h1><a href="/"><img src="/images/prod-logo.png" alt="PROD"/></a></h1>
<a name="skipnav"></a> 