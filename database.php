<?php
class Database
{
    private $db_name = 'mysql:host=localhost;dbname=crud_html';
    private $db_user = 'root';
    private $db_pass = '';
    private $con = null;

    public $response = array();

    function __construct()
    {
        $this->con = new PDO($this->db_name, $this->db_user, $this->db_pass);
    }

    function selectAll($table, $join = null, $where = null)
    {
        if ($this->tableExists($table)) {
            $query = "SELECT * FROM $table"; // JOIN class_info WHERE student_info.sclass = class_info.cid";
            if ($join != null) {
                $query .= " JOIN $join";
            }
            if ($where != null) {
                $query .= " WHERE $where";
            }

            $res = $this->con->prepare($query);
            $res->execute();

            // echo '<pre>';
            // print_r($res->fetchAll(PDO::FETCH_ASSOC));
            // echo '</pre>';
            $this->response = $res->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    function select($columns = array(), $table, $join = null, $where = null)
    {
        if ($this->tableExists($table)) {
            $column = implode(", ", $columns);
            $query = "SELECT $column FROM $table";
            if ($join != null) {
                $query .= " JOIN $join";
            }
            if ($where != null) {
                $query .= " WHERE $where";
            }

            $res = $this->con->prepare($query);
            $res->execute();

            // echo '<pre>';
            // print_r($res->fetchAll(PDO::FETCH_ASSOC));
            // echo '</pre>';
            $this->response = $res->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    function insert($table, $column_values = array())
    {
        if ($this->tableExists($table)) {
            $column = implode(', ', array_keys($column_values));
            $values = implode("', '", $column_values);

            $query = "INSERT INTO $table($column) VALUES('$values') ";

            // echo ($query);

            $res = $this->con->prepare($query);

            if ($res->execute()) {
                echo "Value inserted and ID is: " . $this->con->lastInsertId();
            }
        }
    }

    function update($table, $values = array(), $where = null)
    {
        if ($this->tableExists($table)) {
            $key_value = array();
            foreach ($values as $key => $value) {
                $key_value[] = "$key = '$value'";
            }
            $query = "UPDATE $table SET " . implode(', ', $key_value);
            if ($where != null) {
                $query .= " WHERE $where";
            }

            // echo $query;
            $res = $this->con->prepare($query);
            $res->execute();

            $this->response = $res->fetchAll();
        }
    }

    function delete($table, $where = null)
    {
        if ($this->tableExists($table)) {
            $query = "DELETE FROM $table WHERE $where";

            $res = $this->con->prepare($query);
            $res->execute();

            $this->response[] = "Data deleted successfully";
        }
    }

    private function tableExists($table)
    {
        $query = "SHOW TABLES FROM crud_html LIKE '$table'";

        $res = $this->con->prepare($query);
        $res->execute();

        if ($res->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function getResponse()
    {
        return $this->response;
    }

    function __destruct()
    {
        $this->response = array();
        $this->con = null;
    }
}
