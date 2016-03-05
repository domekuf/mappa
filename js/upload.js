var stato = $("#stato").val();

$('#upload').fileupload({
	dataType: "json",
	dropZone: $('#rilascia'),
	add: function(e, dati) {
		var XHR = dati.submit();
	},
	progress: function(e, dati) {
		stato.html("Caricamento in corso...");
	},
	done: function(e, dati) {
		stato.html("Terminato!");
	},
	fail: function(e, dati) {
		stato.html("Errore imprevisto durante l'upload!");
	}
});