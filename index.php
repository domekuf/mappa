<!DOCTYPE html>
<html>
<head>
	<title>Mappa</title>
	<meta charset="UTF-8">
	
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap-theme.css">
	
	<script src="js/jquery-1.12.0.min.js"></script>
	
	<!-- File citati precedentemente -->
	<script src="js/jquery.ui.widget.js"></script>
  	<script src="js/jquery-ui.js"></script>
	<script src="js/jquery.iframe-transport.js"></script>
	<script src="js/jquery.fileupload.js"></script>
	<script>
  $(function() {
    $( ".draggable" ).draggable();
  });
  </script>
</head>
<body >
<div style="background: url('file.png') no-repeat center center fixed;z-index:-10" class="container row">
<div class="col-xs-12" style="margin:50px" id="pins">


<?php
	$myfile = fopen("list.html", "r+");
	echo fread($myfile,filesize("list.html"));
	fclose($myfile);
?>
<?php
	$my2file = fopen("cont.html", "r+");
	echo fread($my2file,filesize("cont.html"));
	fclose($my2file);
?>
</div>
</div>
<div style="position:fixed;bottom:0px" class=" well col-xs-6">
<div id="mostra" style="display:none" class="form-control btn btn-warning " onclick="show_form()"><i class="glyphicon glyphicon-plus "> </i> Mostra</div>
 <form class="file-form form-group-sm" method="post" enctype="multipart/form-data">
 			 <div class="checkbox">
   			<label>
				<input type="checkbox" id="vertical" name ="vertical"/> Verticale
    		</label>
  			</div>
			<div class="btn-group"> 
			<button type="button" class="btn btn-success " onclick="addPin($('#testo').val(),$('#vertical'))">
				<i class="glyphicon glyphicon-plus "> </i> 
				Aggiungi
			</button>
			<button type="button" class="btn btn-warning " onclick="hide_form()">
				<i class="glyphicon glyphicon-minus " id="nascondi"> </i> 
				Nascondi
			</button>
			<button type="button" class="btn btn-danger " onclick="reset_list()">
				<i class="glyphicon glyphicon-remove "> </i> 
				Reset
			</button>
			<button class="btn btn-info" id="upload-button0" type="submit" name="submit">
				<i class="glyphicon glyphicon-upload "> </i> 
				Carica Sfondo
			</button> 
			</div>
			<input class="form-control" type="text" id="testo" placeholder="Testo"/>

			
			<select class="form-control" id="sel-class">
			<option value="primary">blu</option>
			<option value="info">azzurro</option>
			<option value="warning">arancione</option>
			<option value="danger">rosso</option>
			<option value="succes">verde</option>
			</select>
			
			<input class="file-select form-control" type="file" name="files[]" id="fileToUpload0" multiple>

</form>
		
</div>
</div>
<div class="modal progress" id="myModal">
  <div class="progress-bar progress-bar-striped active" id="progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
    <span class="sr-only">0% Complete</span>
  </div>
</div>
<div style="display:none">
<audio id="ok" controls>
<source src="ok.mp3" type="audio/mpeg">
</audio>

<audio id="ko" controls>
<source src="ko.mp3" type="audio/mpeg">
</audio>
</div>


</body>

<script>
//$('#aux')[0].play();
var usr_selected='';
function usr_mousedown(user){	
	usr_selected=user.attr('id');
	$('#usr_selected').val(usr_selected);
	//console.log(usr_selected);
	//pi.requestQ('asd','asd');
}
function usr_mouseup(user){
	//console.log(usr_selected);
	$('#'+usr_selected).css('z-index',2);
	usr_selected='';
}

function grp_mouseup(group){
	console.log(group);
	$('#'+usr_selected).css('z-index',4);
	if(usr_selected==group){
		$('#ok')[0].play();
	}else{
		$('#ko')[0].play();
	}
}
var form = [];
var fileSelect = [];
var uploadButton = [];
form[0] = document.getElementsByClassName("file-form")[0];
console.log(form[0]);
fileSelect[0] = document.getElementsByClassName("file-select")[0];
console.log(fileSelect[0]);
uploadButton[0] = $("#upload-button0");
uploadButton[0].onclick = function(event){
	event.preventDefault();
}
form[0].onsubmit = function (event) {
	
var randomId = new Date().getTime();
	event.preventDefault();
	// Update button text.
	uploadButton[0].val("Caricamento...");
	// Get the selected files from the input.
	var files = fileSelect[0].files;
	// Create a new FormData object.
	var formData = new FormData();
	// Loop through each of the selected files.
	for (var i = 0; i < files.length; i++) {
	var file = files[i];
	
	// Check the file type.
	//if (!file.type.match(\'image.*\')) {
	//	continue;
	//}
	
	// Add the file to the request.
	var final_filename="[login_utente]_all0_[id_trasf]_[id_dett]_"+file.name;
	formData.append("files[]", file, file.name);
	}
	// Files
	formData.append(name, file);
	
	// Blobs
	//formData.append(name, blob, filename);
	
	 //Strings
	//formData.append(name, value, filename);    
	// Set up the request.
	var xhr = new XMLHttpRequest();
	xhr.upload.addEventListener("progress", function(evt) {
            if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;
                console.log(percentComplete);
                $('#progressbar').css('width',((percentComplete*100)+'%'));
            }
       }, false);
	xhr.addEventListener("progress", function(evt) {
           if (evt.lengthComputable) {
               var percentComplete = evt.loaded / evt.total;
               console.log(percentComplete);
                $('#progressbar').css('width',((percentComplete*100)+'%'));
    	  }
	}, false);

	// Open the connection.
	xhr.open("POST", "/mappa/upload4.php", true);
	
	// Set up a handler for when the request finishes.
	xhr.onload = function () {
		//alert("open");
	if (xhr.status === 200) {
		//alert("File Caricati");
		// File(s) uploaded.
        $('#progressbar').css('width','100%');
        $('#myModal').modal('hide');
		uploadButton[0].val("Carica Sfondo");
		$("body").css("background", "url(file.png" + "?random=" + randomId + ") no-repeat center center fixed");
	} else {
		alert("Errore!");
	}
	};
	// Send the Data.
	xhr.send(formData);
	$('#progressbar').css('width','0%');
    $('#myModal').modal('show');
}
var xhttp;
if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
    } else {
    // code for IE6, IE5
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
$('.draggable').draggable();
function addPin(text,vertical){
	vertical=vertical.is(':checked');
	$('#pins').append('<div class="btn btn-'+$('#sel-class').val()+' draggable '+(vertical==1?'vertical':'')+'"><i class="glyphicon glyphicon-pushpin "> </i>'+text+'</div>');
	$('.draggable').draggable();
	xhttp.open("GET", "write.php?testo="+text+"&rot="+vertical+"&class="+$('#sel-class').val(), true);
	xhttp.send();
}
function reset_list(){
var r = confirm("Cancelliamo tutto?");
if (r == true) {
    $('#pins').html('');
	xhttp.open("GET", "delete.php", true);
	xhttp.send();
} else {
    alert("Ci siamo salvati in corner");
}
	
}
function hide_form(){
	$('form').hide('slow');	
	$('#mostra').show('slow');	
	
}
function show_form(){
	$('form').show('slow');
	$('#mostra').hide('slow');	
}


</script>
<script src="js/bootstrap.js"></script>
</html>