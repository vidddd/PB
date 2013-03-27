function bind() {
	  $(".icantidad").blur(update_price);
	  $(".iprecio").blur(update_price);
	  $(".idescuento").blur(update_price);
	}

function bindAlbaran() {
	  $(".icantidad").blur(update_price_albaran);
	  $(".iprecio").blur(update_price_albaran);
	  update_total_albaran();
	}


function update_price() {
	  var row = $(this).parents('.item-row');
	  
	  if( row.find('.idescuento').val() != '') {
		  var price =  row.find('.iprecio').val() * row.find('.icantidad').val();
		  var dto = price * row.find('.idescuento').val() / 100;
		  price = price - dto; 
	  } else {
		  var price = row.find('.iprecio').val() * row.find('.icantidad').val(); 
	  }
	  price = roundNumber(price,2);
	  if(isNaN(price)){ row.find('.totallinea').html("N/A") } else {
		  row.find('.totallinea').html(price);
		  row.find('.itotal').val(price)
	  }
	  update_total();
	}

function update_price_albaran() {
	  var row = $(this).parents('.item-row');

	 if( row.find('.iprecio').val() != '' ){
		  var price = row.find('.iprecio').val() * row.find('.icantidad').val();
		  price = roundNumber(price,2);
		  if(isNaN(price)){ row.find('.totallinea').html("N/A") } else {
			  row.find('.totallinea').html(price);
			  row.find('.itotal').val(price)
		  }

		  update_total_albaran();
	  }
	}
function update_precios(id){
	  var row = $('#'+id).parents('.item-row');

	  if( row.find('.iprecio').val() != '' && row.find('.icantidad').val() != '' ){
		  var price = row.find('.iprecio').val() * row.find('.icantidad').val();
		  price = roundNumber(price,2);
		  if(isNaN(price)){ row.find('.totallinea').html("N/A") } else {
			  row.find('.totallinea').html(price);
			  row.find('.itotal').val(price)
		  }

		  update_total_albaran();
	  }
}

function update_total() {
	  var total = 0;

	  $('.totallinea').each(function(i){
	    price = $(this).html();
	    if (!isNaN(price)) total += Number(price);
	  });
	  total = roundNumber(total,2);
	  $('.neto').html(total+"€");$('.iimporte').val(total);
	  var iva = total * 21 / 100;
	  iva = roundNumber(iva,2);
	  $('.iva').html(iva+"€");$('.iiva').val(iva);
	  var total2 = Number(total) + Number(iva);total2 = roundNumber(total2,2);
	  $('.total2').html(total2+"€");$('.itotal2').val(total2);
	}

function update_total_albaran() {
	  var total = 0;
	  var iva = $('#ivah').val();
	  var descuento = $('#descuentoh').val();
	  var recargo = $('#recargoh').val();
	  $('.totallinea').each(function(i){
	    price = $(this).html();
	    if (!isNaN(price)) total += Number(price);
	  });
	  // IMPORTE NETO
	  total = roundNumber(total,2);
	  $('.neto').html(total+"€");

      // DESCUENTO
	  if(descuento !=  '0') {
		  var descuentot = total * descuento / 100;
	  } else {
		  var descuentot = 0;
	  }
	  $('.descuento-label span').html(descuento);
	  $('.descuento').html(roundNumber(descuentot,2) +"€");
	  
	  //BASE IMPONIBLE
	  baseimp = roundNumber(total - descuentot,2);
	  $('.baseimponible').html(baseimp +"€");
	  
	  //IVA 
	  var tipo = $('#factura_tipo').val();
	  if(!tipo){
		  var tipo = $('#albaran_tipo').val();
	  }
	  if(tipo == '1'){
		  iva = baseimp * iva / 100;
		  iva = roundNumber(iva,2);
		  $('.iva').html(iva+"€");$('.iiva').val(iva);
		  
		  //RECARGO
		  if(recargo == '1'){
			  var recargot = baseimp * 5.2 / 100;
		  } else {
			  var recargot = 0;
		  }
		  recargot = roundNumber(recargot,2);
		  $('.recargo').html(recargot +"€");
		  //TOTAL
		  var total2 = Number(baseimp) + Number(iva) + Number(recargot); 
	   } else {
		  var total2 = Number(baseimp);
	   }
	  total2 = roundNumber(total2,2);
	  $('.total2').html(total2+"€");$('.itotal2').val(total2);
	}


//from http://www.mediacollege.com/internet/javascript/number/round.html
function roundNumber(number,decimals) {
    var amt = parseFloat(number);
    return amt.toFixed(2);
}
