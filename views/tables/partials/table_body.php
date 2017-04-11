<table class="striped">
    <thead>
    <tr>
        <?php foreach ($tableHeaders as $th) {
            if ($th['column_name'] !== 'password' && $th['column_name'] !== 'session')
                echo '<th>' . $th['column_name'] . '</th>';
        } ?>
    </tr>
    </thead>

    <tbody>
    <?php
    if ($userLabel >= $tables[$tableName]) { ?>
        <?php foreach ($tableRows as $tr) {
            unset($tr['password']);
            unset($tr['session']);

            echo '<tr data-key="' . $tr['id'] . '">';

            foreach ($tr as $column => $td) {
                echo '<td>' . $td
                    . ($tableHeadersJoin[$column] ? ' (' . $tableHeadersJoin[$column][$td] . ') ' : '')
                    . '</td>';
            }

            if ($clearanceLevel == 0) {
                echo "<td><input data-object='" . json_encode($tr) . "' type='radio' name='rows' id = '" . $tr['id'] . "' value='" . $tr['id'] . "'/>"
                    . "<label for='" . $tr['id'] . "'></label></td>";
            }

            echo '</tr>';
        } ?>
    <?php } ?>
    </tbody>
</table>
