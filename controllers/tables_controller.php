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
        require_once('views/tables/index.php');
    }

    public function details()
    {
        if (User::getCurrentUser() == null)
            return call('error', 'unauthorized');

        if (empty($_GET['table']))
            return call('error', 'error');

        // todo: skip some of these depending on labels
        $userLabel = User::getCurrentUser()->label;
        $tables = $this->getTables();
        $tableName = $_GET['table'];
        $tableHeaders = $this->getTableHeaders($tableName);
        $tableRows = $this->getTableRows($tableName);
        $tableHeadersJoin = $this->getTableHeadersJoin($tableHeaders, $tables);

        require_once('views/tables/details.php');
    }

    // todo: implement 3 methods below
    public function insert()
    {
        if (User::getCurrentUser() == null)
            return call('error', 'unauthorized');

        $this->forceRedirectTo("/pg-bsk/index.php");
    }

    public function update()
    {
        if (User::getCurrentUser() == null)
            return call('error', 'unauthorized');
    }

    public function delete()
    {
        if (User::getCurrentUser() == null)
            return call('error', 'unauthorized');
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
        // todo: handle PDOException when user inputs sth stupid
        $where = empty($_POST['where']) ? '' : $_POST['where'];
        $query = Db::getInstance()->prepare("SELECT * FROM $tableName " . ($where ? ' WHERE ' . $where : '') . " ORDER BY id");
        $query->execute();
        $tableRows = $query->fetchAll(PDO::FETCH_ASSOC);
        return $tableRows;
    }

    // todo: replace this hack with a proper solution
    private function forceRedirectTo($url)
    {
        echo '<script type="text/javascript">
           window.location = "' . $url . '"</script>';
    }
}
