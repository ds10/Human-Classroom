<tr>
	<td><div id="term-{$term.term_id}">{$term.term}</div></td>
	<td><div id="term-{$term.term_id}-class">{if $term.class_name}{$term.class_name}{else}*unknown*{/if}</div></td>
	<td><form id="mul-{$term.term_id}"><input id="multiple-{$term.term_id}" type="checkbox" onChange="setmultiple({$term.term_id},$F('multiple-{$term.term_id}'));" {if $term.multiple eq 1}checked{/if}/></form></td>
	<td><form id="br-{$term.term_id}"><input id="necessary-{$term.term_id}" type="checkbox" onChange="setnecessary({$term.term_id},$F('necessary-{$term.term_id}'));"  {if $term.necessary eq 1}checked{/if}/></form></td>
	<td><form id="sc-{$term.term_id}"><input id="scalable-{$term.term_id}" type="checkbox" onChange="setscalable({$term.term_id},$F('scalable-{$term.term_id}'));" {if $term.scalable eq 1}checked{/if}/></form></td>
	<td><div id="scale-{$term.term_id}">{$term.scale}</div></td>
	
	{literal}
	<script type="text/javascript">
	
	new Ajax.InPlaceEditor( 'term-{/literal}{$term.term_id}{literal}', 'taxonomy-editinplace.php');

	new Ajax.InPlaceEditor( 'scale-{/literal}{$term.term_id}{literal}', 'taxonomy-editinplace.php');
	
	new Ajax.InPlaceCollectionEditor('term-{/literal}{$term.term_id}{literal}-class', 'taxonomy-editinplace.php', {
 	collection: [{/literal}
  		{foreach item=class from=$classes}'{$class.name}',{/foreach}
  	{literal}]
  
		});


		
	</script>
	{/literal}
	
	
</tr>