<div id="updateModal" class="modal">
    <div class="modal-content">
        <h4>Update</h4>
        <form id="updateForm" action="index.php?controller=tables&action=update" method="post">
            <?php
            foreach ($tableHeaders as $header) {
                $column = $header['column_name'];

                if ($column === 'id') echo '<input type="hidden" id="updateId" name="id" value=""/>';
                else {
                    ?><label for="<?= $column ?>"><?= $column ?></label>
                    <?php if ($tableHeadersJoin[$column]) { ?>
                        <select class="browser-default" name="<?= $column ?>">
                            <?php
                            foreach ($tableHeadersJoin[$column] as $key => $value) { ?>
                                <option value="<?= $key ?>"><?= $value ?></option>
                            <?php } ?>
                        </select>
                    <?php } else { ?>
                        <input type="text" name="<?= $column ?>"/>
                        <?php
                    }
                }
            } ?>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" onclick="sendUpdateForm()" class="modal-action modal-close waves-effect waves-green btn">Update</a>
        <a href="#!" class="modal-close btn-flat ">Cancel</a>
    </div>
</div>
