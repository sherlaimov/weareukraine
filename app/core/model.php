<?php

class Model
{
    protected $_mysql;
    protected $_where = array();
    protected $_query;
    protected $_paramTypeList;

    public function __construct()
    {
        $this->_mysql = new mysqli(DB_HOST, DB_USER, DB_PSWD, DB_NAME) or
        die ('There was a problem connecting to DB');

    }

    public function query($query)
    {
        //we never use the native MySQLi query?
        $this->_query = filter_var($query, FILTER_SANITIZE_STRING);
        $stmt = $this->_prepareQuery();
        $stmt->execute();

        $results = $this->_dynamicBindResults($stmt);
        return $results;
    }

    public function get($table, $numRows = NULL, $order = NULL)
    {
        $this->_query = "SELECT * FROM $table";
        $stmt = $this->_buildQuery($numRows, false, $order);
        $stmt->execute();

        $results = $this->_dynamicBindResults($stmt);
        return $results;
    }

    function insert($table, $insertData)
    {
        $this->_query = "INSERT INTO $table";
        //var_dump($insertData); die;
        $stmt = $this->_buildQuery(NULL, $insertData);
        $stmt->execute();

        if ($stmt->affected_rows) {
            return true;
        }

    }

    public function update($table, $updateData)
    {
        $this->_query = "UPDATE $table SET ";
        $stmt = $this->_buildQuery(NULL, $updateData);
        $stmt->execute();
        if ($stmt->affected_rows)
            return true;
    }

    public function delete($table)
    {
        $this->_query = "DELETE FROM $table";
        $stmt = $this->_buildQuery();
        $stmt->execute();
        if ($stmt->affected_rows)
            return true;
    }

    public function where($whereProp, $whereValue)
    {
        $this->_where[$whereProp] = $whereValue;
    }

    protected function _buildQuery($numRows = NULL, $tableData = false, $order = NULL)
    {
        $hasTableData = null;
        if (gettype($tableData) === 'array') {
            $hasTableData = true;
        }
        //Did the user call the where method?

        if (!empty($this->_where)) {
            $keys = array_keys($this->_where);
            $where_prop = $keys[0]; //note_id
            $where_value = $this->_where[$where_prop];

            //if UPDATE data was passed, filter through
            //and create the SQL query, accordingly
            if ($hasTableData) {
                $i = 1;
                $pos = strpos($this->_query, 'UPDATE');

                //throw new Exception('12312');
                //var_dump($tableData); die;

                if ($pos !== false) {
                    $this->_paramTypeList = '';
                    foreach ($tableData as $prop => $val) {
                        //determine what data type the item is
                        $this->_paramTypeList .= $this->_determineType($val);

                        //prepare the rest of the SQL query
                        //UPDATE table SET title = ? WHERE
                        if ($i === count($tableData)) {
                            $this->_query .= $prop . ' =? WHERE ' . $where_prop .
                                '= ' . $where_value;
                        } else {
                            $this->_query .= $prop . ' =?, ';
                        }
                        $i++;
                    }
                }
            } else {
                // no table data was passed. Might be SELECT stmt
                $this->_paramTypeList = $this->_determineType($where_value);
                $this->_query .= ' WHERE ' . $where_prop . '= ?';
            }
        }


        //Determine if is INSERT query
        if ($hasTableData) {
            $pos = strpos($this->_query, 'INSERT');

            if ($pos !== false) {
                //is INSERT statement
                $keys = array_keys($tableData);
                $values = array_values($tableData);
                $num = count($keys);


                $this->_paramTypeList = '';
                //wrap values in quotes
                foreach ($values as $k => $v) {
                    $values[$k] = "'{$v}'";
                    $this->_paramTypeList .= $this->_determineType($v);
                }
                //INSERT INTO table ('title', 'body')
                $this->_query .= '(' . implode(', ', $keys) . ')';
                //VALUES (?, ?); no commat at the end!
                $this->_query .= ' VALUES(';
                while ($num !== 0) {
                    ($num !== 1) ? $this->_query .= '?, ' : $this->_query .= '?)';
                    $num--;
                }
            }
        }
        //if ORDER is set
        if ($order) {
            $this->_query .= ' ' . $order;
        }
        //if the user set a LIMIT
        if (isset($numRows)) {
            $this->_query .= ' LIMIT ' . (int)$numRows;
        }
        $stmt = $this->_prepareQuery();

        //Bind parameters
        if ($hasTableData) {
            $args = array();
            $args[] = $this->_paramTypeList;
            foreach ($tableData as $prop => $val) {
                $args[] = &$tableData[$prop];
            }

//            var_dump($args); die;

            call_user_func_array(array($stmt, 'bind_param'), $args);

        } else if ($this->_where) {
            $stmt->bind_param($this->_paramTypeList, $where_value);
            //$stmt->bind_param('i', 7);
        }
        return $stmt;

    }

    protected function _determineType($item)
    {
        //$item = 7
        //these are what we need for MySQLimproved to bind_param()!
        switch (gettype($item)) {
            case 'string' :
                $paramType = 's';
                break;
            case 'integer' :
                $paramType = 'i';
                break;
            case 'blob' :
                $paramType = 'b';
                break;
            case 'double' :
                $paramType = 'd';
                break;
        }
        return $paramType;
    }

    protected function _dynamicBindResults($stmt)
    {
        $params = array();
        $results = array();
        $meta = $stmt->result_metadata();

        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }
        call_user_func_array(array($stmt, 'bind_result'), $params);

        while ($stmt->fetch()) {
            $x = array();
            //print_r($row);
            foreach ($row as $k => $v) {
                $x[$k] = $v;
            }
            $results[] = $x;
        }
        return $results;
    }

    protected function _prepareQuery()
    {
//         var_dump($this->_mysql->prepare($this->_query));die;

//        print_r($this->_query);
        if (!$stmt = $this->_mysql->prepare($this->_query)) {
            echo 'Last SQL query was - ' . $this->_query;
            trigger_error('Problem preparing query', E_USER_ERROR);
        }

        return $stmt;
    }

    function __destruct()
    {
        //$this->_mysql->close();
    }

}