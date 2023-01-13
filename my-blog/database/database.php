<?php

namespace Catalog\Mysql;

class Database
{
    private
        $host = 'localhost',
        $user = 'root',
        $pwd = '',
        $database = 'blog-app',
        $conn;

    public function connect()
    {
        $this->conn = mysqli_connect(
            $this->host,
            $this->user,
            $this->pwd,
            $this->database
        );
    }

    public function close()
    {
        mysqli_close($this->conn);
    }

    public function select($query)
    {
        $data = [];
        $result = mysqli_query($this->conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function insert($table, $data)
    {
        $columns = implode(',', array_keys($data));
        $values = implode("','", array_values($data));
        $sql = "INSERT INTO $table ($columns) VALUES ('$values')";

        $result = mysqli_query($this->conn, $sql);
        
        if($result) {
            $id = mysqli_insert_id($this->conn);
            $query = "SELECT * FROM $table WHERE id = $id";
            return $this->select($query)[0];
        }

        return false;
    }

    public function update($table, $data, $id)
    {
        $set = '';
        foreach($data as $column => $value) {
            $set .= "$column = '$value',";
        }
        $set = rtrim($set, ',');

        $sql = "UPDATE $table SET $set WHERE id = $id";
        return mysqli_query($this->conn, $sql);
    }

    public function delete($table, $id)
    {
        $sql = "DELETE FROM $table WHERE id = $id";
        return mysqli_query($this->conn, $sql);
    }
}

