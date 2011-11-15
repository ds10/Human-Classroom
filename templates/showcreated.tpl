	<div id="text">

<h1>Enviroment Details</h1>
coming soon..
<h1>Agents Details</h1>

 This is your generated scenario.
<br/>
<br/>
 
  {foreach $agents as $agent}
<div class="person" style="min-height:350px">
 <img src="lib/characters/1.png" style="float: right;">
 {$agent->name} is a {foreach item=prop from=$agent->properties->get_byclass('Agent')} {$prop->term} {/foreach}
 {if $agent->properties->get_bymodule('Agent Variables')}
  <br/><br/>Is:
 	{foreach item=prop from=$agent->properties->get_bymodule('Agent Variables')}
 	{$prop->term}
 	<br/>
 	{/foreach}
 {/if}
 <br/>
  {if $agent->properties->get_bymodule('Environment')}
 Owns:<br/>
 	{foreach item=prop from=$agent->properties->get_bymodule('Environment')}
 	*{$prop->term}
 	<br/>
 	{/foreach}
 {/if}

</div> 
 
 <br/><br/><br/>
 {/foreach}
 
 
 
 <table style="border:1">
 {foreach $classes as $class}
 <th>{$class.name}</th>
 {/foreach}
 
 
 
 </table>
 THIS
 <br/><br/>
 NEEDS
 <br/><br/>
 DOING<br/><br/>
 
 <a href="graphical">Run Simulation</a><br/>
<a href="graphical">Run HTML5 Graphical Version (will need chrome..) </a>
</div>