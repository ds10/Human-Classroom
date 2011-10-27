<?php

require_once("lib/init.php");

// Stop unauthenticated or non-staff people getting in...
// Display the main admin menu

$smarty->display("headers.tpl");

?>

<h2>Admin menu</h2>

<ul>

<li>
<a href="javascript:toggleLayer('projectForm');" title="Add a Project">
Add a Project
</a>
</li>

<div id="projectForm">
<form  method="post" id="newEvent" action="scripts/new.php">
Title: <input type="text" name="title" />
Description: <input type="text" name="description" />
<input type="submit" value="Create">
</form>

</div>

<li><a href="/lib/modules/jisc_scraper.php">JISC Web Scraper Module</a></li>
<li><a href="sanity.php">Sanity checker</a></li>
<li><a href="name-editor.php">Manage project names</a></li>
<li><a href="property-editor.php">Manage Properties</a></li>

<li><a href="get_standards.php">Generate Report</a></li>
<li><a href="taxonomy.php">Edit taxonomies</a></li>
<li><a href="/lib/modules/feeds.php">Manage RSS/Atom feeds</a></li>
<li><a href="converters/old_db_converter.php">OLD DB Converter</a></li>
<li><a href="converters/jisc_spreadsheet_converter.php">JISC Spreadsheet Converter</a></li>
</ul>


 
<?php

$smarty->display("footers.tpl");

?>