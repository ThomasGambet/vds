<div class="row">
    <div class="col-md-4 col-12">
        <label for="date" class="col-form-label obligatoire">Date </label>
        <input id="date"
               type='date'
               style="width: 160px;"
               required
               value='<?= isset($date) ? $date : "" ?>'
               min='<?= isset($min) ? $min : "" ?>'
               max='<?= isset($max) ? $max : "" ?>'
               class="form-control ctrl ">
        <div id='msgdate' class='messageErreur'></div>
    </div>
    <div class="col-md-4 col-12">
        <label for="nom" class="col-form-label obligatoire">Type </label>
        <select id="type" class="form-select ctrl ">
            <option value="public" selected>public</option>
            <option value="privé">privé</option>
        </select>
    </div>
    <div class="col-md-8 col-12">
        <label for="nom" class="col-form-label obligatoire">Nom </label>
        <input id="nom"
               type="text"
               required
               minlength="10"
               maxlength="70"
               pattern="^[0-9A-Za-zÀÇÈÉÊàáâçèéêëî]((.)*[0-9A-Za-zÀÇÈÉÊàáâçèéêëî!])*$"
               class="form-control ctrl"
               autocomplete="off">
        <div id='msgnom' class='messageErreur'></div>
    </div>
</div>
<label for="description" class="col-form-label">Description</label>
<textarea id='description' style="min-height: 350px" class="form-control"></textarea>
<div id="msgdescription" class='messageErreur'></div>
