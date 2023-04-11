<div class="input-group mb-3 col-6">
    <a href="ajout.php" class="btn btn-success ">
        Ajouter
    </a>
    <button id="btnEpurer" class="btn btn-danger" style="visibility: hidden;">Supprimer les événéments passés</button>
</div>
<div class='table-responsive'>
    <div class='table-responsive'>
        <table class='table table-sm table-borderless table-hover tablesorter-bootstrap' id='leTableau'>
            <thead>
            <tr>
                <th style="width: 100px">Action</th>
                <th style="width: 100px">Date</th>
                <th>Evénement</th>
                <th>Type</th>
                <th>Modifier par</th>
                <th>Ajouter par</th>

            </tr>
            </thead>
            <tbody id="lesLignes"></tbody>
        </table>
    </div>
</div>
