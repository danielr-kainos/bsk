<?php
error_reporting(E_ALL);
$clearanceLevel = $userLabel - $tables[$tableName];
?>


<div class="row">
    <div class="col">
        <h2 class="header"><?= $tableName ?></h2>
        <p id="userLabel" style="display:none"><?= $userLabel ?></p>
        <p id="tableLabel" style="display:none"><?= $tables[$tableName] ?></p>
    </div>
    <div class="col">
        <a id="insertBtn" href="#insertModal" class="modal-trigger btn add-new <?= ($clearanceLevel > 0 ? 'disabled' : '') ?>">INSERT</a>
        <a id="updateBtn" href="#updateModal" class="modal-trigger btn add-new <?= ($clearanceLevel != 0 ? 'disabled' : '') ?>">UPDATE</a>
        <a id="deleteBtn" href="#deleteModal" class="modal-trigger btn red add-new <?= ($clearanceLevel != 0 ? 'disabled' : '') ?>">DELETE</a>
    </div>
</div>

<div class="row where-form">
    <form method="POST" action="/pg-bsk/?controller=tables&action=details&table=<?= $tableName ?>">
        <div class="input-field col s9 m6 l4">
            <input id="where" name="where" type="text">
            <label for="where">Where...</label>
        </div>
        <div class="col s3">
            <button type="submit" class="btn add-new" <?= ($clearanceLevel < 0 ? 'disabled' : '') ?>>SELECT</button>
        </div>
    </form>
</div>

<div class="card-panel">
    <?php
    if ($clearanceLevel >= 0) {
        require_once("views/tables/partials/table_body.php");
    } else {
        echo '<h5>You don\'t have permissions necessary to view those records</h5>';
    }?>
</div>

<?php require_once("views/tables/partials/insert_modal.php"); ?>
<?php require_once("views/tables/partials/update_modal.php"); ?>
<?php require_once("views/tables/partials/delete_modal.php"); ?>
