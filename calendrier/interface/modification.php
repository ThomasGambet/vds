<div class="formulaire">
    <div class="row mb-3">
        <div class="col-sm-6 col-12 ">
            <label for="date" class="obligatoire col-form-label">Date de l'épreuve</label>
            <input id='date'
                   type="date"
                   style="width: 200px;"
                   class="form-control ctrl"
                   required
            >
            <div id="msgdate" class='messageErreur'></div>
        </div>
        <div class="col-sm-6 ">
            <label for="numero" class="obligatoire col-form-label">Numéro FFA</label>
            <input id='numero'
                   type="text"
                   style="width: 200px;"
                   class="form-control ctrl"
                   required
                   pattern="^[0-9]{6}"
                   minlength="6"
                   maxlength="6"
            >
            <div id="msgnumero" class='messageErreur'></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-6">
            <label class='obligatoire col-form-label' for="Nom">Nom de l'épreuve</label>
            <input id='nom' type="text" class="form-control ctrl"
                   required
                   minlength="5"
                   maxlength="70">
            <div id="msgnom" class="messageErreur"></div>
        </div>
        <div class="col-sm-6">
            <label for="distance" class="col-form-label">Distances proposées</label>
            <input type="text" id='distance'
                   class="form-control ctrl"
                   maxlength="30"
            >
            <div id="msgdistance" class="messageErreur"></div>
        </div>
    </div>
    <div class="d-flex justify-content-evenly">
        <button id="btnModifier" class="btn btn-danger mt-3">Modifier</button>
        <a href="index.php" class="btn btn-sm btn-outline-dark m-2 shadow-sm ">
            <i class="bi bi-arrow-90deg-up"></i>
            Annuler
        </a>
    </div>
</div>