"use strict"

window.onload = () => {
    nom.value = "test ajout épreuve";
    numero.value = "123456";
    distance.value = "10 et 15";
    // activation de composant  de mise en forme des cases à cocher
    $(':checkbox').checkboxpicker();
    btnAjouter.onclick = ajouter;
}

function ajouter() {
    Std.effacerLesErreurs();
    if (!Std.donneesValides()) return
    let monFormulaire = new FormData();
    monFormulaire.append('nom', nom.value.toUpperCase());
    monFormulaire.append('numero', numero.value);
    monFormulaire.append('date', date.value);
    monFormulaire.append('challenge', challenge.checked ? 1 : 0);
    monFormulaire.append('label', label.checked ? 1 : 0);
    if (distance.value.length > 0) monFormulaire.append('distance', distance.value.toLowerCase());
    $.ajax({
        url: 'http://formation/api/calendrier/',
        method: 'POST',
        timeout: 0,
        headers: {
            "Authorization": "Bearer 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",
            "Cookie": "PHPSESSID=6cmml52aba8em2icgskl2a8d8q"
        },
        dataType: 'JSON',
        processData: false,

        contentType: false,
        data: monFormulaire,
        success: (data) => {
            if (data.message) {
                Std.afficherErreur(data.message);
            } else if (data.error) {
                for (const erreur of data.error) {
                    if (erreur.champ === 'msg') {
                        msg.innerHTML = Std.genererMessage(erreur.message);
                    } else {
                        let champ = document.getElementById('msg' + erreur.champ)
                        champ.innerText = erreur.message;
                    }
                }
            } else if (data.success) {
                Std.retournerVers(data.success, 'index.php');
            } else {
                Std.afficherErreur("Le serveur n'a pas renvoyé de réponse, contacter la maintenance");
            }
        },
        error: (reponse) => {
            msg.innerHTML = Std.genererMessage("L'opération a échoué, contacter la maintenance")
            // console.error(reponse.responseText)
        }
    });
}