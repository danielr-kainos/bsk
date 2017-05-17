<?php

class TablesController
{
    //todo: clean all this mess
    //todo: rename variables here and in views
    public function index()
    {
        if (User::getCurrentUser() == null)
            return call('error', 'unauthorized');

        $tables = $this->getTables();

        $viewPath = 'views/tables/index.php';
        require_once('views/layout.php');
    }

    public function details()
    {
        if (User::getCurrentUser() == null)
            return call('error', 'unauthorized');

        if (empty($_GET['table']))
            return call('error', 'error');

        $userLabel = User::getCurrentUser()->label;
        $tables = $this->getTables();
        $tableName = $_GET['table'];
        $tableHeaders = $this->getTableHeaders($tableName);

        $clearanceLevel = $userLabel - $tables[$tableName];
        if ($clearanceLevel >= 0) {
            $tableRows = $this->getTableRows($tableName);
            $tableHeadersJoin = $this->getTableHeadersJoin($tableHeaders, $tables);
        }

        $viewPath = 'views/tables/details.php';
        require_once('views/layout.php');
    }

    public function insert()
    {
        $this->checkUserAccess('less_or_equal');

        $formData = $_POST['data'];
        $tableName = $_POST['tableName'];
        $columnTypes = $this->getColumnTypes($formData, $tableName);
        $queryText = $this->buildInsertQuery($formData, $tableName, $columnTypes);

        $query = Db::getInstance()->prepare($queryText);
        $query->execute();

        die();
    }

    public function update()
    {
        $this->checkUserAccess('equal');

        $formData = $_POST['data'];
        $tableName = $_POST['tableName'];
        $columnTypes = $this->getColumnTypes($formData, $tableName);
        $queryText = $this->buildUpdateQuery($formData, $tableName, $columnTypes);

        $query = Db::getInstance()->prepare($queryText);
        $query->execute();

        die();
    }

    public function delete()
    {
        $this->checkUserAccess('equal');

        $recordId = $_POST['recordId'];
        $tableName = $_POST['tableName'];

        $q = Db::getInstance()->prepare("DELETE FROM $tableName WHERE id = $recordId");
        $q->execute();

        die();
    }

    private function getTables()
    {
        $tables = array();
        foreach (Db::getInstance()->query("SELECT * FROM tables") as $table) {
            $tables[$table['name']] = $table['label'];
        }
        return $tables;
    }

    private function getTableHeaders($tableName)
    {
        $tableName = strtolower($tableName);
        $query = Db::getInstance()->query("
            SELECT column_name FROM information_schema.columns
            WHERE table_schema='public' AND table_name = '$tableName'
        ");
        $tableHeaders = $query->fetchAll(PDO::FETCH_ASSOC);
        return $tableHeaders;
    }

    private function getTableHeadersJoin($tableHeaders, $tables)
    {
        $tableHeadersJoin = Array();
        $userLabel = User::getCurrentUser()->label;

        foreach ($tableHeaders as $header) {
            $columnName = $header['column_name'];
            $joinedTableHeader = false;
            $t = str_replace('_id', '', $columnName) . '_view';
            if (strpos($columnName, '_id') && $userLabel >= $tables[$t]) {
                $q = Db::getInstance()->query("SELECT id, name as name FROM $t ORDER BY id");
                foreach ($q->fetchAll(PDO::FETCH_ASSOC) as $r) {
                    $joinedTableHeader[$r['id']] = $r['name'];
                }
            }

            $tableHeadersJoin[$header['column_name']] = $joinedTableHeader;
        }

        return $tableHeadersJoin;
    }

    private function getTableRows($tableName)
    {
        try {
            $where = empty($_POST['where']) ? '' : $_POST['where'];
            $query = Db::getInstance()->prepare("SELECT * FROM $tableName " . ($where ? ' WHERE ' . $where : '') . " ORDER BY id");
            $query->execute();
            $tableRows = $query->fetchAll(PDO::FETCH_ASSOC);
            return $tableRows;
        } catch (Exception $e) {
            call('error', 'error');
        }
    }

    private function getColumnTypes($formData, $tableName)
    {
        $typeOf = '';
        $i = 0;
        foreach ($formData as $k => $v) {
            if ($i++) {
                $typeOf .= ', ';
            }
            $column = $v['name'];
            $typeOf .= "pg_typeof($column) as $column";
        }

        $q = Db::getInstance()->query("SELECT $typeOf FROM {$tableName}");
        return $q->fetch(PDO::FETCH_ASSOC);
    }

    private function buildInsertQuery($formData, $tableName, $columnTypes)
    {
        $i = 0;
        $values = '';
        $cols = '';
        foreach ($formData as $k => $v) {
            $c = $v['name'];
            if ($c !== 'id') {
                if (++$i !== 1) {
                    $values .= ', ';
                    $cols .= ', ';
                }
                $cols .= $c;
                if (
                    $columnTypes[$c] == "character varying" ||
                    $columnTypes[$c] == "date" ||
                    $columnTypes[$c] == "text"
                ) {
                    if ($tableName == 'Users' && $c == 'password')
                        $values .= "crypt('" . $v['value'] . "', gen_salt('bf', 8))";
                    else
                        $values .= "'" . $v['value'] . "'";
                } else
                    $values .= intval($v['value']);
            }
        }
        return "INSERT INTO $tableName ({$cols}) VALUES ({$values})";
    }

    private function buildUpdateQuery($formData, $tableName, $columnTypes)
    {
        $i = 0;
        $id = 0;
        $values = '';
        foreach ($formData as $k => $v) {
            $c = $v['name'];
            if ($c !== "id") {
                $i++;
                if ($i != 1) {
                    $values .= ', ';
                }
                $values .= $c . '= ';
                if (
                    $columnTypes[$c] == "character varying" ||
                    $columnTypes[$c] == "date" ||
                    $columnTypes[$c] == "text"
                ) {
                    if ($tableName == 'Users' && $c == 'password')
                        $values .= "crypt('" . $v['value'] . "', gen_salt('bf', 8))";
                    else
                        $values .= "'" . $v['value'] . "'";
                } else
                    $values .= intval($v['value']);
            } else $id = intval($v['value']);
        }
        return "UPDATE $tableName SET {$values} WHERE id = $id";
    }

    private function checkUserAccess($param)
    {
        if (User::getCurrentUser() == null) {
            call('error', 'unauthorized');
            die();
        }

        $userLabel = User::getCurrentUser()->label;
        $tableName = $_POST['tableName'];
        $tableLabel = $this->getTables()[$tableName];

        if ($param == 'equal') {
            if ($userLabel !== $tableLabel) {
                call('error', 'unauthorized');
                die();
            }
        }
        else if ($param == 'less_or_equal') {
            if ($userLabel > $tableLabel) {
                call('error', 'unauthorized');
                die();
            }
        }
        else if ($userLabel < $tableLabel) {
            call('error', 'unauthorized');
            die();
        }
    }
}
