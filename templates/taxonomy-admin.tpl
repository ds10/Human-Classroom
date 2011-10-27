<div id="text">
<!--  
<h2>ADMIN: Taxonomies</h2>
-->
<br/><br/><br/><br/>
<table width = "100%">
{foreach item=term from=$taxonomies}

	{if $term.module_name <> $previousmodule}
<tr><td colspan="3"><h2>{$term.module_name}</h2></td></tr>
<tr><td colspan="3"><div><i>{$term.description}</i></div></td></tr>

<tr><td colspan="3"><form action="taxonomy.php" method="post">
			Add a new term: <input type="text" id="term_name" name="term_name"/>
			<input type="hidden" name="module_id" id="module_id" value="{$term.module_id}"/>
			<input type="hidden" name="action" id="action" value="new_term"/>
			<input type="submit" label="GO" id="submit"/>
		</form>
		{assign var='previousmodule' value=$term.module_name}
<br/>
	</td></tr>
	
	<tr style="font-weight:bold;"><td>Term</td><td>Class</td><td>Multiple</td><td>Must Have</td><td>Scalable</td><td>Scale 1 - 100</td></tr>


	{/if}

	{if $term.term}{include file="term-admin.tpl"}{/if}

	
{/foreach}

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


{literal}
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
{/literal}

</div>