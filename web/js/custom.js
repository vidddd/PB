$(document).ready(function() { 

	// Navigation menu
	$(".numeric").numeric({ negative : false });
	$(".numeric-negative").numeric();
	//$(".numeric").numeric(","); //Sólo con esta instanciación tenemos que podemos escribir números y una coma
	$('.date').datepicker({ dateFormat: 'yy-mm-dd' })


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
		show_title: false, /* true/false */
		allow_resize: true, /* Resize the photos bigger than viewport. true/false */
		default_width: 500,
		default_height: 344,
		counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
		theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
		horizontal_padding: 20, /* The padding on each side of the picture */
		hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
		wmode: 'opaque', /* Set the flash wmode attribute */
		autoplay: false, /* Automatically start videos: True/False */
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
		iframe_markup: '<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"></iframe>',
		inline_markup: '<div class="pp_inline">{content}</div>',
		custom_markup: '',
		social_tools: false /* html or false to disable */
	});
	// Login Dialog Link
	$('#buscador-ok').click(function(){
		$.prettyPhoto().close();
		return false;
	});
	// Accordion
	$("#accordion, #accordion2").accordion({ header: "h3" });

	// Tabs
	$('#tabs, #tabs2, #tabs5').tabs();
/*
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
*/

	// Dialog auto open			
	$('#welcome_login').dialog({
		autoOpen: true,
		width: 380,
		height: 330,
		bgiframe: true,
		modal: true,
		buttons: {
		/*	"Entrar": function() {
				//$('#dialog').submit();
				 document.form-login.submit();
				//$('#form-login').submit();
			}*/
		}
	});

	// Datepicker
	/*
	$('#datepicker').datepicker({
		inline: true
	});
	*/
	//Hover states on the static widgets
	$('#dialog_link, ul#icons li').hover(
		function() { $(this).addClass('ui-state-hover'); }, 
		function() { $(this).removeClass('ui-state-hover'); }
	);

    
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

	//$(".column").disableSelection();
    // http://fancybox.net/api
	$("a.iframe-mail").fancybox({
		'hideOnContentClick': false,
		'width': 550,
		'height': 600,
		'transitionIn': 'elastic',
		'modal': false,
		'onClosed': function() {
			//window.location.reload();
		                 }
	});
	$("#collapse1").click(function(event) {
		event.preventDefault();
		$("#collapseOne").slideToggle();
		$('#orden_extrusion').attr('checked', 'checked');
	});
	$("#collapse2").click(function(event) {
		event.preventDefault();
		$("#collapseTwo").slideToggle();
		$('#orden_impresion').attr('checked', 'checked');
	});
	$("#collapse3").click(function(event) {
		event.preventDefault();
		$("#collapseThree").slideToggle();
		$('#orden_corte').attr('checked', 'checked');
	});
	$("#collapse4").click(function(event) {
		event.preventDefault();
		$("#collapseFour").slideToggle();
		$('#orden_rebobinado').attr('checked', 'checked');
	});
	$('#orden_extrusion').click(function () {
		$("#collapseOne").slideToggle();
	});
	$('#orden_impresion').click(function () {
		$("#collapseTwo").slideToggle();
	});
	$('#orden_corte').click(function () {
		$("#collapseThree").slideToggle();
	});
	$('#orden_rebobinado').click(function () {
		$("#collapseFour").slideToggle();
	});
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
   
    jQuery(function($){
    	$.datepicker.regional['es'] = {
    		closeText: 'Cerrar',
    		prevText: '&#x3c;Ant',
    		nextText: 'Sig&#x3e;',
    		currentText: 'Hoy',
    		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
    		'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
    		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
    		'Jul','Ago','Sep','Oct','Nov','Dic'],
    		dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
    		dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
    		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
    		weekHeader: 'Sm',
    		dateFormat: 'dd/mm/yy',
    		firstDay: 1,
    		isRTL: false,
    		showMonthAfterYear: false,
    		yearSuffix: ''};
    	$.datepicker.setDefaults($.datepicker.regional['es']);
    });
    
 	/* Check all table rows */
			/*
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
		*/
    function stringToDate(dateString)
    {
        try
        {
            var matches = dateString.match(/([0-9]{4})\-([0-9]{2})\-([0-9]{2})/);
            if(isValidDate(matches[1], matches[2], matches[3]) === false)
            {
                return false;
            }

            return new Date(matches[1], parseInt(matches[2], 10)-1, parseInt(matches[3], 10));
        }
        catch(e)
        {
            return false;
        }
    }

    /**
     * Return whether the supplied date components form the expected date
     * @param {String} year
     * @param {String} month
     * @param {String} day
     * @returns {Boolean} True if the date components match the date values in Date object
     */
    function isValidDate(year, month, day)
    {
        var dt = new Date(parseInt(year, 10), parseInt(month, 10)-1, parseInt(day, 10));
        if(dt.getDate() != parseInt(day, 10) || dt.getMonth() != (parseInt(month, 10)-1) || dt.getFullYear() != parseInt(year, 10))
        {
            return false;
        }

        return true;
    }


    function dateToYYYYMMDD(dateObj)
    {
        var mm = dateObj.getMonth() + 1;
        mm = (mm < 10) ? '0' + mm : mm;
        var dd = dateObj.getDate();
        dd = (dd < 10) ? '0' + dd : dd;
        var yyyy = dateObj.getFullYear();
        var date = yyyy + '-' + mm + '-' + dd;
        return date;
    }