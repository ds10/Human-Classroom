function newcomment(){
	new Ajax.Updater('comments','/comment-edit.php',{parameters:$('commentform').serialize(true),insertion: Insertion.Top});
}

function deletecomment(commentid){
	new Ajax.Request('/comment-edit.php',{parameters:{'action':'delete','comment_id':commentid}});
	var commentc='commentc-'+commentid;
	$(commentc).remove();
}

function publiccomment(commentid){
	new Ajax.Request('/comment-edit.php',{parameters:{'action':'public','comment_id':commentid}});
	window.location.href=window.location.href
	//var commentc='commentc-'+commentid;
}


function hideactivity(activityid){
	new Ajax.Request('/activity-edit.php',{parameters:{'action':'hide','activity_id':activityid}});
	var activityc='activityc-'+activityid;
	$(activityc).remove();
}

function toggleLayer( whichLayer )
{
  var elem, vis;
  if( document.getElementById ) // this is the way the standards work
    elem = document.getElementById( whichLayer );
  else if( document.all ) // this is the way old msie versions work
      elem = document.all[whichLayer];
  else if( document.layers ) // this is the way nn4 works
    elem = document.layers[whichLayer];
  vis = elem.style;
  // if the style.display value is blank we try to figure it out here
  if(vis.display==''&&elem.offsetWidth!=undefined&&elem.offsetHeight!=undefined)
    vis.display = (elem.offsetWidth!=0&&elem.offsetHeight!=0)?'block':'none';
  vis.display = (vis.display==''||vis.display=='block')?'none':'block';
}

function onChange(){

		var selected = document.selectform.term.value;
		if (selected == "greatest-hits"){
		document.selectform.value.value = "http://jisc.cetis.ac.uk/demo";
		}
}

function showAll(){

		var checked = document.getElementById('showallcheck').checked 
		if (checked ==true){ //get a new list thru ajax
	
				new Ajax.Request('/property-list?showallfalse=true' ,
			  {
				method:'get',
				onSuccess: function(transport){
				  var response = transport.responseText || "no response text";
				 // alert("Success! \n\n" + response);
				  setOptions(response);
				  if (response!="Unknown"){
				  $('refinevalue').update(response);
				  $('refinevalue').show();
				  } else {
				  
				  }
				},
				onFailure: function(){ alert('Something went wrong...') },
				onLoading: function(){
					
				}
			  });
				
				
		}else{ //get a list without hidden bits

			new Ajax.Request('/property-list?showall=true' ,
			  {
				method:'get',
				onSuccess: function(transport){
				  var response = transport.responseText || "no response text";
				 // alert("Success! \n\n" + response);
				  setOptions(response);
				  if (response!="Unknown"){
				  $('refinevalue').update(response);
				  $('refinevalue').show();
				  } else {
				  
				  }
				},
				onFailure: function(){ alert('Something went wrong...') },
				onLoading: function(){
					
				}
			  });

		}

}


function setOptions(terms) {
	
	var selbox = document.queryform.refineterm;
	selbox.options.length=0;
 	selbox.options[0]=new Option("All Items","All Items", true, false)
	var term=terms.split(":")


	for (i=0;i<term.length;i++){
		
		if (term[i]!=""){
			selbox.options[i+1]=new Option(term[i], term[i], true, false)
		}
	}
}