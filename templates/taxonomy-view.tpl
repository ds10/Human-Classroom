 <div id="text">

<h2>Model Taxonomy</h2>

<table>
{foreach item=term from=$taxonomies}

	{if $term.module_name <> $previousmodule}
	
        <tr><td colspan="3">	<h3>{$term.module_name}</h3></td></tr>
        <tr><td colspan="3"><div><i>{$term.description}</i></div></td></tr>
        
    
        <tr style="font-weight:bold;"><td>TERM</td><td>Class</td></tr>
    
        {assign var='previousmodule' value=$term.module_name}
	{/if}

	{if $term.term}
        
        <tr>
            <td><div id="term-{$term.term_id}">{$term.term}</div></td>
            <td><div id="term-{$term.term_id}-class">{if $term.class_name}{$term.class_name}{else}*unknown*{/if}</div></td>	
        
        </tr>
        
        
	{/if}

	
{/foreach}
</table>

</div>
	