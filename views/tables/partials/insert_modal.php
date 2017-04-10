<div id="insertModal" class="modal">
    <div class="modal-content">
        <h4>Insert</h4>
        <form>
            <?php
            foreach ($tableHeaders as $header) {
                $column = $header['column_name'];

                if ($column === 'id') echo '<input type="hidden" id="inId" name="id" value=""/>';
                else {
                    ?><label for="<?= $column ?>"><?= $column ?></label>
                    <?php if ($tableHeadersJoin[$column]) { ?>
                        <select name="<?= $column ?>">
                            <?php
                            foreach ($tableHeadersJoin[$column] as $key => $value) { ?>
                                <option value="<?= $key ?>"><?= $value ?></option>
                            <?php } ?>
                        </select><br/>
                    <?php } else { ?>
                        <input type="text" name="<?= $column ?>"/><br/>
                        <?php
                    }
                }
            } ?>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn">Insert</a>
        <a href="#!" class="modal-close btn-flat ">Cancel</a>
    </div>
</div>