
function myFacebox(data, options)
{
	var _this 		= null;
	var _overlay    = null;
	var _options	= null;
	// overlay param
	var _oColor		= '#000000';
	var _oAlpha		= 0.6;


	this.showOverlay = function()
	{
		var w = $(window).width();
		var h = $(window).height();
		if ( $(window).height() > $(window).width() ){
			w = $(window).height()+26;
		} else {
			w = $(window).width()+26;
		}
		$('body').append('<div id="overlay" class="overlay" style="position:fixed;top:0;left:0;width:'+w+'px;height:'+h+'px;background:'+_oColor+';opacity:'+_oAlpha+';display:none;z-index:9998"></div>');
		$('#overlay').fadeIn();
	}
	this.showContent = function(data)
	{
		data = this.analyseContent(data);
		var html = ' <div id="myfacebox" _style="opacity:0;border: 3px solid #303030;background-color:white;padding:5px"> \
	      <div class="popup" > \
	      <div class="close"><img id="fermeture" src="ressources/images/croix_fermeture.png"></div> \
	        <table cellspacing="0" cellpadding="0">  \
	          <tbody> \
	            <tr> \
	              <td class="tl"/><td class="b"/><td class="tr"/> \
	            </tr> \
	            <tr> \
	              <td class="b"/> \
	              <td class="body"> \
	              	<div class="content" style="position:relative"> '+data+'\
	                </div> \
	              </td> \
	              <td class="b"/> \
	            </tr> \
	            <tr> \
	              <td class="bl"/><td class="b"/><td class="br"/> \
	            </tr> \
	          </tbody> \
	        </table> \
	      </div> \
	    </div>';
    	$('body').append(html);
    	
    	setTimeout(function()
    	{
	    	var w = $(window).width();
			var h = $(window).height();
			var fw= $('#myfacebox').find('.content').width();
			var fh= $('#myfacebox').height();
			var top= (h-fh)/2;
			var left= (w-fw)/2;
			// $('.footer').css('border-top', '1px solid grey').css('cursor','pointer').css('font-family','arial').css('font-size','12px').css('width','100%').css('height','25px').css('text-align','right');
			$('.close').css('cursor','pointer').css('height','25px');
			// $('.footer').html('<span style="margin-right:10px;position:relative;top:4px">fermer <strong ">X</strong></span>');
			//$('#myfacebox').css({'position':'fixed','top':top+'px','left':left+'px','z-index':9999});
			$('#myfacebox').animate({opacity:1},1000);
		},250);
	}

	this.analyseContent = function(data)
	{
		if(this._options)
		{
			if(this._options.mode=='iframe')
			{
				var w = this._options.width ? this._options.width : '100%';
				var h = this._options.height ? this._options.height : Math.floor($(window).height()*0.8);
				return '<iframe width="'+w+'" height="'+h+'" frameborder="0" src="'+data+'"></iframe>';
			}
		}
		else // auto detect
		{
			var t = data.split('.');
			if(t.length==2)
			{
				if(t[1]=='html' || t[1]=='php')
					return '<iframe width="100%" height="100%" frameborder="0" src="'+data+'"></iframe>';
			}
			else
				return data;
			
		}
	}


	$(document).delegate('#overlay, #myfacebox .close, #fermeture','click',function(){
		$("#myfacebox").fadeOut(function(){
			$("#myfacebox").remove();
			$('#overlay').remove();
		});
		$("#overlay").fadeOut();
	});
	
	if(options)
		this._options = options;
	this.showOverlay();
	this.showContent(data);
	_this = this;
}