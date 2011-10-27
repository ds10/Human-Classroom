// Rules

var _filter="all";
var _page = 1;
var _url = 'scripts/eventlist.php';

function refresh(page,filter){
	_page=page;
	_filter=filter;
	var ajax = new Ajax.Updater({success: 'eventList'}, _url,{method: 'get', parameters: "page="+page+"&filter="+filter, onFailure: null});
} 

function editevent(id){
			var url="scripts/entryform.php";
			var ajax = new Ajax.Updater({success: 'editor'}, url,{method: 'get', parameters: 'id='+id , onFailure: null});
			
			new Effect.Appear('editor-bib');
			
			var targetDiv = $('editor');
			new Effect.BlindDown(targetDiv,{duration: 0.5});
			

			//new Effect.Fade(this);
			//Effect.Appear('close', {delay: 1});
}

function showdetails(id){
			var url="scripts/eventdetails.php";
			var ajax = new Ajax.Updater({success: 'eventdetails_'+id}, url,{method: 'get', parameters: 'event_id='+id , onFailure: null});
			
			new Effect.Appear('editor-bib');

			var targetDiv = $('eventdetails_'+id);
			new Effect.BlindDown(targetDiv,{duration: 0.5});
			//new Effect.Fade(this);
			//Effect.Appear('close', {delay: 1});
}


function delevent(id){
		var dia=$('dialog');
		dia.innerHTML="<h2>Are you sure you want to delete event #"+id+"?</h2> <a href='javascript:void(0);' onClick='conf_delevent("+id+");'>YES</a> &nbsp; <a href='javascript:void(0);' onClick='hidedialog();'>No</a>";
		new Effect.Appear('dialog',{duration: 0.3});
		
}

function hidedialog(){
		new Effect.Fade('dialog',{duration: 0.3});
}

function conf_delevent(id){
		var url="scripts/deleteevent.php";
		var ajax = new Ajax.Updater({success:null}, url,{method: 'get', parameters: 'id='+id , onFailure: null});
		
		if (_filter=="tentative"){_filter="all"};
			refresh(_page, _filter);
		new Effect.Fade('dialog',{duration: 0.3});
}

function nextpage(){
	_page++;
	refresh(_page, _filter);
}

function prevpage(){
	_page--;
	refresh(_page, _filter);
}


var myrules = {
	'#start': function(element){
		element.onblur = function(){
			magicDate(this);		
		}
	},
	'#end': function(element){
		element.onblur = function(){
			magicDate(this);		
		}	},
	'#open' : function(element){
		element.onclick = function(){
			var url="scripts/entryform.php";
			
			var ajax = new Ajax.Updater({success: 'editor'}, url,{method: 'get', parameters: null, onFailure: null});
			
						new Effect.Appear('editor-bib');
						
			var targetDiv = $('editor');
			new Effect.BlindDown(targetDiv,{duration: 0.5});
			new Effect.Fade(this, {duration: 1});
			Effect.Appear('close', {delay: 1});
		}	},
	'#edit' : function(element){
		element.onclick = function(){
			var url="scripts/entryform.php";
			var ajax = new Ajax.Updater({success: 'editor'}, url,{method: 'get', parameters: 'id=3', onFailure: null});
			
			new Effect.Appear('editor-bib');
			
			var targetDiv = $('editor');
			new Effect.BlindDown(targetDiv,{duration: 0.5});
			new Effect.Fade(this);
			Effect.Appear('close', {delay: 1});
		}	},
		
	'#submitUpdate' : function(element){
		element.onclick = function(){
     		this.value='Saving...';
			var params = Form.serialize('updateEvent');
			
			// send the add event
			var url="scripts/updateevent.php";
			var ajaxadd = new Ajax.Updater({success: null}, url,{method: 'get', parameters:params, onFailure: null});
			
			// clear the form and hide the panel
			var targetDiv = $('utils');
			new Effect.BlindUp(targetDiv,{duration: 0.5});
			new Effect.Fade('close'); 
			Effect.Appear('open', {delay: 1});
		}	},
	'#submitAdd' : function(element){
		element.onclick = function(){
     		this.value='Saving...';
			var params = Form.serialize('newEvent');
			
			// send the add event
			var url="scripts/addevent.php";
			var ajaxadd = new Ajax.Updater({success: null}, url,{method: 'get', parameters:params, onFailure: null});
			
			// clear the form and hide the panel
			var targetDiv = $('utils');
			new Effect.BlindUp(targetDiv,{duration: 0.5});
			new Effect.Fade('close'); 
			Effect.Appear('open', {delay: 1});
			
			// refresh the event list and go back to page 0
			// this should show the new event. An effect on the
			// new item would be nice, too.
			_page = 1;
			if (_filter=="tentative"){_filter="all"};
			refresh(_page, _filter);
		}
	},
	'#close' : function(element){
		element.onclick = function(){
			var targetDiv = $('editor');
			new Effect.BlindUp(targetDiv,{duration: 0.5});
			new Effect.Fade(this); 
			Effect.Appear('open', {delay: 1});
		}	},
	'#filterAll': function(element) {
        element.onclick = function(){
			_filter = "all";
			_page = 1;
			refresh(_page, _filter);
		}
    }, 

			
    '#filterTentative': function(element) {
        element.onclick = function(){
			_filter = "tentative";
			_page = 1;
			refresh(_page, _filter);
        }    },
        
    '#filterConfirmed': function(element) {
        element.onclick = function(){
			_filter = "confirmed";
			_page = 1;
			refresh(_page, _filter);
        
		}
    },
		
	'#filterPast': function(element) {
        element.onclick = function(){
			_filter = "past";
			_page = 1;
			refresh(_page, _filter);
        
		}
    },
		
	'#nextpage': function(element){
		element.onclick = function(){
			_page++;
			refresh(_page, _filter);
		}	},
	'#prevpage': function(element){
		element.onclick = function(){
			if (_page > 1){_page--};
			refresh(_page, _filter);
		}	}
};
