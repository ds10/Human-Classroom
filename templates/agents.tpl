	<div id="text">



<h1>Agents</h1>

 These are your generated agents. Please give them an agent type:
<br/>
<br/>
 
 
 
 <table>


	
	
	<tr style="font-weight:bold;"><td>Agent Name</td><td>Type</td></tr>

 
 {foreach item=agent from=$agents}

 <tr>
	<td><div id="agent-{$agent.agent_id}">{$agent.agent_name}</div></td>
	<td><div id="agent-{$agent.agent_id}-classag">*unknown*</div></td>

	
	{literal}
	<script type="text/javascript">
	
	new Ajax.InPlaceEditor( 'agent-{/literal}{$agent.agent_id}{literal}', 'taxonomy-editinplace.php');
	//pipe this up
	new Ajax.InPlaceCollectionEditor('agent-{/literal}{$agent.agent_id}{literal}-classag', 'taxonomy-editinplace.php', {
	 	collection: [{/literal}
	  		{foreach item=class from=$agent_types}'{$class.agent_type}',{/foreach}
	  	{literal}]
	  
			});
	
	</script>
	{/literal}
	
	
</tr>
{/foreach}

</table>
<br/><br/>
<a href="?create=generate"> My Agents are done, now generate a scenario! </a>
</div>