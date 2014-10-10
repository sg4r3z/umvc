$(function(){
	$("#piu").on({
		click:function(){
			AggiungiRiga();
			}
	})
})
function RimuoviRiga(riga){
	var rowlimit = $('table tr').length
	if($('table tr').length == riga){
	$('table tr:eq('+(riga-1)+')').remove()
	}else{
	alert('Elimina l\'ultima riga '+rowlimit)
	$('table tr:last').addClass('limit')
	}
}
function AggiungiRiga(){
	//  onKeyUp="CalcolaTotale('+num+')" 
	var num = $('table tr').length
	  $("table").append('<tr>\
						  <td><input type="text" placeholder="codice" name="codice'+num+'" id="codice'+num+'" value="" /></td>\
						  <td><input type="text" placeholder="descrizione" name="descrizione'+num+'" id="descrizione'+num+'" value="" /></td>\
						  <td><input type="text" placeholder="prezzo" name="prezzo'+num+'" id="prezzo'+num+'" value=""/></td>\
						  <td><input type="text" placeholder="quantita" name="quantita'+num+'" id="quantita'+num+'" value=""  /></td>\
						  <td ><span class="btn btn-primery" onclick="RimuoviRiga('+(num+1)+')">'+(num+1)+'</span></td>\
						 </tr>'); 
}
function CalcolaTotale(row){
	var qt = ($("#quantita"+row).val()=="")? 0 : $("#quantita"+row).val();
	var pz = ($("#prezzo"+row).val()=="")? 0 : $("#prezzo"+row).val();
	var subtotale = (parseInt(qt)*parseInt(pz));
	if(subtotale==0){$("#totale"+row).val('');}else{$("#totale"+row).val(subtotale)}
}
