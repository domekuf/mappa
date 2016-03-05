<?
if(!empty($_FILES["file"])) {
	foreach ($_FILES["file"]["name"] as $indice => $nome) {
    if($_FILES["file"]["error"] == 0) {
        $estensione = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

        if($estensione == "png" || $estensione == "jpg") {
            if($_FILES["file"]["size"][$indice] < 10000000) {
                $risultato = move_uploaded_file($_FILES["file"]["tmp_name"][$indice], $_SERVER["DOCUMENT_ROOT"] . "/" . $_FILES["file"]["name"]);
                if($risultato) {
                    echo "File spostato con successo!";
                } else {
                    die("Errore imprevisto durante lo spostamento dell'immagine! :(");
                }
            } else {
                die("Il file selezionato è troppo grande, non deve superare 1MB!");
            }
        } else {
            die("Estensione non consentita! Hai cercato di caricare un file ." . $estensione . "!");
        }
    } else {
        die("Errore imprevisto durante il caricamento dell'immagine! :(");
    }
	}
} else {
    die("Nessun file selezionato.");
}
?>