"use strict"
// identifiant de l'épreuve en cours de modification
let id

window.onload = () => {

    date.value = data.date;
    numero.value = data.numero;
    nom.value = data.nom;
    distance.value = data.distance;
    id = data.id;

    btnModifier.onclick = () => {
        Std.effacerLesErreurs()
        if (!Std.donneesValides()) return;

        let data = {
            id: id,
            nom: nom.value.toUpperCase(),
            numero: numero.value.toUpperCase(),
            date: date.value,
        }
        if (distance.value.length > 0) data.distance = distance.value.toLowerCase(),

            $.ajax({
                    url: 'http://formation/api/calendrier/',
                    type: 'PATCH',
                    headers: {
                        "Authorization": "Bearer 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",
                        "Content-Type": "application/json"
                    },
                    dataType: "json",
                    data: JSON.stringify(data),
                    success: (data) => {
                        if (data.message) {
                            Std.afficherErreur(data.message)
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
                            msg.innerHTML = Std.genererMessage("Réponse non attendue du serveur, contacter la maintenance");
                            console.error(data);
                        }
                    },
                    error: (reponse) => {
                        msg.innerHTML = Std.genererMessage("L'opération a échoué, contacter la maintenance")
                        console.error(reponse.responseText)
                    }
                }
            );
    }
}