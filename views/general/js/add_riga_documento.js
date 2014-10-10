$(function(){
	$("#piu").on({
		click:function(){
			AggiungiRiga();
			}
	})
})
function RimuoviRiga(riga){
	
	// sottraggo 1 per l'intestazione
	var rowlimit = parseInt($('table tr').length)-1;
	
	// rimuovi
	if(rowlimit-1 == riga){
		$('table tr:eq('+(riga+1)+')').remove()
	    $("#quante_righe").val($("#quante_righe").val()-1);
	}
	// riga centrale non puoi eliminare
	else{
		alert('Elimina l\'ultima riga '+(rowlimit))
		//$('table tr:last').addClass('limit')
	}
}
function AggiungiRiga(){
	//  onKeyUp="CalcolaTotale('+num+')" 
	var num = parseInt($('table tr').length)-1;
	  $("table").append('<tr>\
						  <td><input class="form-control" type="text" name="codice'+num+'" id="codice'+num+'" value="" /></td>\
						  <td><input class="form-control" type="text" required="true" name="descrizione'+num+'" id="descrizione'+num+'" value="" /></td>\
						  <td><input class="form-control" pattern="\\d+(\\.\\d+)?" required="true" type="text" name="prezzo_unitario'+num+'" id="prezzo'+num+'" value=""/></td>\
						  <td><input class="form-control" pattern="\\d+" required="true" type="text"  name="quantita'+num+'" id="quantita'+num+'" value=""  /></td>\
						  <td ><span class="btn btn-primary btn-block" onclick="RimuoviRiga('+num+')"><span class="glyphicon glyphicon-trash"></span> Elimina Riga</span></td>\
						 </tr>'); 
						 
	 $("#quante_righe").val(parseInt($("#quante_righe").val())+1);
}
function CalcolaTotale(row){
	var qt = ($("#quantita"+row).val()=="")? 0 : $("#quantita"+row).val();
	var pz = ($("#prezzo"+row).val()=="")? 0 : $("#prezzo"+row).val();
	var subtotale = (parseInt(qt)*parseInt(pz));
	if(subtotale==0){$("#totale"+row).val('');}else{$("#totale"+row).val(subtotale)}
}
