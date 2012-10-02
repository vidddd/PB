$(document).ready(function() { 

	// Navigation menu
	$(".numeric").numeric();
	//$(".numeric").numeric(","); //Sólo con esta instanciación tenemos que podemos escribir números y una coma
	$('.date').datepicker({ dateFormat: 'dd-mm-yy' })


	$('ul#navigation').superfish({ 
		delay:       1000,
		animation:   {opacity:'show',height:'show'},
		speed:       'fast',
		autoArrows:  true,
		dropShadows: false
	});
	
	$('ul#navigation li').hover(function(){
		$(this).addClass('sfHover2');
	},
	function(){
		$(this).removeClass('sfHover2');
	});
    //prettyPhoto
	$("a[rel^='prettyPhoto']").prettyPhoto({
		animation_speed: 'fast', /* fast/slow/normal */
		slideshow: 5000, /* false OR interval time in ms */
		autoplay_slideshow: false, /* true/false */
		opacity: 0.50, /* Value between 0 and 1 */
		show_title: true, /* true/false */
		allow_resize: true, /* Resize the photos bigger than viewport. true/false */
		default_width: 500,
		default_height: 344,
		counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
		theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
		horizontal_padding: 20, /* The padding on each side of the picture */
		hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
		wmode: 'opaque', /* Set the flash wmode attribute */
		autoplay: true, /* Automatically start videos: True/False */
		modal: false, /* If set to true, only the close button will close the window */
		deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
		overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
		keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
		changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
		callback: function(){}, /* Called when prettyPhoto is closed */
		ie6_fallback: true,
		markup: '<div class="pp_pic_holder"> \
					<div class="ppt">&nbsp;</div> \
					<div class="pp_top"> \
						<div class="pp_left"></div> \
						<div class="pp_middle"></div> \
						<div class="pp_right"></div> \
					</div> \
					<div class="pp_content_container"> \
						<div class="pp_left"> \
						<div class="pp_right"> \
							<div class="pp_content"> \
								<div class="pp_loaderIcon"></div> \
								<div class="pp_fade"> \
									<a href="#" class="pp_expand" title="Expand the image">Expand</a> \
									<div class="pp_hoverContainer"> \
										<a class="pp_next" href="#">next</a> \
										<a class="pp_previous" href="#">previous</a> \
									</div> \
									<div id="pp_full_res"></div> \
									<div class="pp_details"> \
										<div class="pp_nav"> \
											<a href="#" class="pp_arrow_previous">Previous</a> \
											<p class="currentTextHolder">0/0</p> \
											<a href="#" class="pp_arrow_next">Next</a> \
										</div> \
										<p class="pp_description"></p> \
										{pp_social} \
										<a class="pp_close" href="#">Close</a> \
									</div> \
								</div> \
							</div> \
						</div> \
						</div> \
					</div> \
					<div class="pp_bottom"> \
						<div class="pp_left"></div> \
						<div class="pp_middle"></div> \
						<div class="pp_right"></div> \
					</div> \
				</div> \
				<div class="pp_overlay"></div>',
		gallery_markup: '<div class="pp_gallery"> \
							<a href="#" class="pp_arrow_previous">Previous</a> \
							<div> \
								<ul> \
									{gallery} \
								</ul> \
							</div> \
							<a href="#" class="pp_arrow_next">Next</a> \
						</div>',
		image_markup: '<img id="fullResImage" src="{path}" />',
		flash_markup: '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"></embed></object>',
		quicktime_markup: '<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="{autoplay}"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="{autoplay}" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>',
		iframe_markup: '<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"></iframe>',
		inline_markup: '<div class="pp_inline">{content}</div>',
		custom_markup: '',
		social_tools: false /* html or false to disable */
	});
	
	// Accordion
	$("#accordion, #accordion2").accordion({ header: "h3" });

	// Tabs
	$('#tabs, #tabs2, #tabs5').tabs();

	// Dialog			
	$('#dialog').dialog({
		autoOpen: false,
		width: 600,
		bgiframe: false,
		modal: false,
		buttons: {
			"Ok": function() { 
				$(this).dialog("close"); 
			}, 
			"Cancel": function() { 
				$(this).dialog("close"); 
			} 
		}
	});
	
	// Login Dialog Link
	$('#login_dialog').click(function(){
		$('#login').dialog('open');
		return false;
	});

	// Login Dialog			
	$('#login').dialog({
		autoOpen: false,
		width: 300,
		height: 230,
		bgiframe: true,
		modal: true,
		buttons: {
			"Login": function() { 
				$(this).dialog("close"); 
			}, 
			"Close": function() { 
				$(this).dialog("close"); 
			} 
		}
	});
	
	// Dialog Link
	$('#dialog_link').click(function(){
		$('#dialog').dialog('open');
		return false;
	});

	// Dialog auto open			
	$('#welcome').dialog({
		autoOpen: true,
		width: 470,
		height: 180,
		bgiframe: true,
		modal: true,
		buttons: {
			"Close this dialog box": function() { 
				$(this).dialog("close"); 
			}
		}
	});

	// Dialog auto open			
	$('#welcome_login').dialog({
		autoOpen: true,
		width: 370,
		height: 430,
		bgiframe: true,
		modal: true,
		buttons: {
			"Proceed to demo !": function() {
				window.location = "index.php";
			}
		}
	});

	// Datepicker
	$('#datepicker').datepicker({
		inline: true
	});
	
	//Hover states on the static widgets
	$('#dialog_link, ul#icons li').hover(
		function() { $(this).addClass('ui-state-hover'); }, 
		function() { $(this).removeClass('ui-state-hover'); }
	);
	
	//Sortable
/*
	$(".column").sortable({
		connectWith: '.column'
	});
*/
	//Sidebar only sortable boxes
	$(".side-col").sortable({
		axis: 'y',
		connectWith: '.side-col'
	});

	$(".portlet").addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
		.find(".portlet-header")
			.addClass("ui-widget-header")
			.prepend('<span class="ui-icon ui-icon-circle-arrow-s"></span>')
			.end()
		.find(".portlet-content");

	$(".portlet-header .ui-icon").click(function() {
		$(this).toggleClass("ui-icon-circle-arrow-n");
		$(this).parents(".portlet:first").find(".portlet-content").slideToggle();
	});

	$(".column").disableSelection();

	
});

	/* Tooltip */

	$(function() {
		$('.tooltip').tooltip({
			track: true,
			delay: 0,
			showURL: false,
			showBody: " - ",
			fade: 250
			});
		});
		
	/* Theme changer - set cookie */

    $(function() {
       
		$("link[title='style']").attr("href","css/styles/default/ui.css");
        $('a.set_theme').click(function() {
           	var theme_name = $(this).attr("id");
			$("link[title='style']").attr("href","css/styles/" + theme_name + "/ui.css");
			$.cookie('theme', theme_name );
			$('a.set_theme').css("fontWeight","normal");
			$(this).css("fontWeight","bold");
        });
		
		var theme = $.cookie('theme');
	    
		if (theme == 'default') {
	        $("link[title='style']").attr("href","css/styles/default/ui.css");
	    };
	    
		if (theme == 'light_blue') {
	        $("link[title='style']").attr("href","css/styles/light_blue/ui.css");
	    };
	

	/* Layout option - Change layout from fluid to fixed with set cookie */
       
       $("#fluid_layout a").click (function(){
			$("#fluid_layout").hide();
			$("#fixed_layout").show();
			$("#page-wrapper").removeClass('fixed');
			$.cookie('layout', 'fluid' );
       });

       $("#fixed_layout a").click (function(){
			$("#fixed_layout").hide();
			$("#fluid_layout").show();
			$("#page-wrapper").addClass('fixed');
			$.cookie('layout', 'fixed' );
       });

	    var layout = $.cookie('layout');
	    
		if (layout == 'fixed') {
			$("#fixed_layout").hide();
			$("#fluid_layout").show();
	        $("#page-wrapper").addClass('fixed');
	    };

		if (layout == 'fluid') {
			$("#fixed_layout").show();
			$("#fluid_layout").hide();
	        $("#page-wrapper").addClass('fluid');
	    };
	
    });
    
    
 	/* Check all table rows */
	
var checkflag = "false";
function check(field) {
if (checkflag == "false") {
for (i = 0; i < field.length; i++) {
field[i].checked = true;}
checkflag = "true";
return "check_all"; }
else {
for (i = 0; i < field.length; i++) {
field[i].checked = false; }
checkflag = "false";
return "check_none"; }
}