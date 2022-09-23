<?php
/**
 * Interface d'ajout d'un membre
 */

require '../include/initialisation.php';
require '../include/controleacces.php';
$titreFonction = "Nouveau membre";
require RACINE . '/include/head.php';
?>

<script src="index.js"></script>

<!-- interface d'ajout et modification -->
<div class="border p-3 mt-3">
    <div id="msg" class="m-3"></div>
    <div class="row">
        <div class="col-md-6 col-12">
            <label for="nom" class="col-form-label">Nom </label>
            <input id="nom"
                   type="text"
                   class="form-control ctrl  "
                   required
                   maxlength='30'
                   pattern="^[A-Za-z]([A-Za-z ]*[A-Za-z])*$"
                   autocomplete="off">
            <div class='messageErreur'></div>
        </div>
        <div class="col-md-6 col-12">
            <label for="prenom" class="col-form-label">Prénom </label>
            <input id="prenom"
                   type="text"
                   class="form-control ctrl "
                   required
                   maxlength='50'
                   pattern="^[A-Za-z]([A-Za-z ]*[A-Za-z])*$"
                   autocomplete="off">
            <div class='messageErreur'></div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6 col-12">
            <label for="email" class="col-form-label">Logo du partenaire</label>
            <input type="text"
                   id="email"
                   required
                   pattern="^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*[\.][a-zA-Z]{2,4}$"
                   class="form-control ctrl "
                   autocomplete="off">
            <div class='messageErreur'></div>
        </div>
    </div>
    <div class="text-center">
        <button id='btnAjouter' class="btn btn btn-danger">Ajouter</button>
    </div>
</div>

<!-- Liste des partenaires -->
<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <b>Liste des partenaires</b>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Nom du partenaire</th>
                    <th class="text-center">Logo</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                $img = array();
                $fpath = 'data/img';
                $files = is_dir($fpath) ? scandir($fpath) : array();
                foreach ($files as $val) {
                    if (!in_array($val, array('.', '..'))) {
                        $n = explode('_', $val);
                        $img[$n[0]] = $val;
                    }
                }
                $gallery = $sql->query("SELECT * FROM partenaire order by id asc");
                while ($row = $gallery->fetch_assoc()):
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i++ ?></td>
                        <td class="">
                            <img src="<?php echo isset($img[$row['id']]) && is_file($fpath . '/' . $img[$row['id']]) ? $fpath . '/' . $img[$row['id']] : '' ?>"
                                 class="gimg" alt="">
                        </td>
                        <td class="">
                            <?php echo $row['about'] ?>
                        </td>
                        <td class="">
                            <?php echo $row['category_id'] ?>
                        </td>
                        <td class="">
                            <?php echo $row['batch'] ?>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-primary edit_gallery" type="button"
                                    data-id="<?php echo $row['id'] ?>" data-about="<?php echo $row['about'] ?>"
                                    data-category_id="<?php echo $row['category_id'] ?>"
                                    data-batch="<?php echo $row['batch'] ?>"
                                    data-src="<?php echo isset($img[$row['id']]) && is_file($fpath . '/' . $img[$row['id']]) ? $fpath . '/' . $img[$row['id']] : '' ?>">
                                Éditer
                            </button>
                            <button class="btn btn-sm btn-danger delete_gallery" type="button"
                                    data-id="<?php echo $row['id'] ?>">Supprimer
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require RACINE . '/include/pied.php'; ?>


