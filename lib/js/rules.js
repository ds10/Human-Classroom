// Rules
            var commDiv = $('communities');
            new Effect.BlindUp(commDiv,{duration: 0.5});
			new Effect.Fade(this);
			Effect.Appear('close', {delay: 1});
            Effect.Fade('closeCommunities',{duration: 0.5});
            Effect.Appear('openCommunities', {delay: 1});
	'#close' : function(element){
			new Effect.BlindUp(targetDiv,{duration: 0.5});
			new Effect.Fade(this); 
			Effect.Appear('open', {delay: 1});
		}
	},
    '#openCommunities' : function(element){
            var utilDiv = $('utils');
            new Effect.BlindUp(utilDiv,{duration: 0.5});
			new Effect.Fade(this);
            Effect.Appear('open', {delay: 1});
            Effect.Fade('close',{duration: 0.5});
			Effect.Appear('closeCommunities', {delay: 1});
	'#closeCommunities' : function(element){
			new Effect.BlindUp(targetDiv,{duration: 0.5});
			new Effect.Fade(this); 
			Effect.Appear('openCommunities', {delay: 1});
		}
	},
	'#allCategories': function(element) {
        element.onclick = function(){
            var url = 'categories';
            var ajax = new Ajax.Updater({success: 'categoriesResult'}, url,{method: 'get', parameters: null, onFailure: null});
        }
    },
    '#popularCategories': function(element) {
        element.onclick = function(){
            var url = 'categoriespopular';
            var ajax = new Ajax.Updater({success: 'categoriesResult'}, url,{method: 'get', parameters: null, onFailure: null});
        }
    }