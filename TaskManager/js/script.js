function editerEtape(item) {
	var buttonEdit = item;
	var id = item.id.substr(13);
	var buttonSubmit = document.getElementById('btn-save-item'+id);
	var buttonCancel = document.getElementById('btn-canc-item'+id);
	var buttonDelete = document.getElementById('btn-dele-item'+id);
	var buttonMail = document.getElementById('btn-mail-item'+id);
	var form = document.getElementById('form-item'+id);

	buttonEdit.style.display = "none";
	buttonDelete.style.display = "none";
	buttonMail.style.display = "none";
	buttonSubmit.style.display = "inline";
	buttonCancel.style.display = "inline";
	form.style.visibility = "visible";
}

function cancelEditerEtape(item) {
	var buttonCancel = item;
	var id = item.id.substr(13);
	var buttonSubmit = document.getElementById('btn-save-item'+id);
	var buttonEdit = document.getElementById('btn-edit-item'+id);
	var buttonDelete = document.getElementById('btn-dele-item'+id);
	var buttonMail = document.getElementById('btn-mail-item'+id);
	var form = document.getElementById('form-item'+id);

	buttonEdit.style.display = "inline";
	buttonDelete.style.display = "inline";
	buttonMail.style.display = "inline";
	buttonSubmit.style.display = "none";
	buttonCancel.style.display = "none";
	form.style.visibility = "hidden";
}

function effacerEtape(idEtape, type) {
	var reponse = confirm("Fréro tu veux vraiment supprimer cette étape super importante ????");
	if (reponse == true) {
		if (type != "") {
			document.location.href="index.php?controller=etape&action=deleted&idEtape=" + idEtape + "&categorie=" + type;
		} else {
			document.location.href="index.php?controller=etape&action=deleted&idEtape=" + idEtape;
		}
	}
}

function editerFleche(item) {
	var buttonEdit = item;
	var id = item.id.substr(15);
	var buttonDelete = document.getElementById('btn-dele-fleche'+id);
	var form = document.getElementById('form-fleche'+id);

	buttonEdit.style.display = "none";
	buttonDelete.style.display = "none";
	form.style.display = "inline";
}

function cancelEditerFleche(item) {
	var buttonCancel = item;
	var id = item.id.substr(15);
	var buttonEdit = document.getElementById('btn-edit-fleche'+id);
	var buttonDelete = document.getElementById('btn-dele-fleche'+id);
	var form = document.getElementById('form-fleche'+id);

	buttonEdit.style.display = "inline";
	buttonDelete.style.display = "inline";
	form.style.display = "none";
}

function effacerFleche(idFleche, type) {
	var reponse = confirm("Fréro tu veux vraiment supprimer cette fléche super importante ????");
	if (reponse == true) {
		if (type != "") {
			document.location.href="index.php?controller=fleche&action=deleted&idFleche=" + idFleche + "&categorie=" + type;
		} else {
			document.location.href="index.php?controller=fleche&action=deleted&idFleche=" + idFleche;
		}
	}
}

function redirection(ancre, path) {
	if (path == null) {
		if (ancre == null) {
			document.location.href="index.php";
		} else {
			document.location.href="index.php" + ancre;
		}
	} else {
		if (ancre == null) {
			document.location.href="index.php" + path;
		} else {
			document.location.href="index.php" + path + ancre;
		}
	}
}
