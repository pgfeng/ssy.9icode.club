<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
class mysqliDriver extends Db
{
    public $mysqli;

    function connect()
    {
        //=====使用长连接
        $mysqli = new mysqli('p:'.Config::database('host'), Config::database('user'), Config::database('pass'), Config::database('name'));
        if ($mysqli->connect_error) {
            Debug::add('连接数据库失败：<font color=red>' . $mysqli->connect_error . '</font>');
            exit('连接数据库失败：<font color=red>' . $mysqli->connect_error . '</font>');
        } else {
            $this->mysqli = $mysqli;
            $this->exec('set names ' . Config::database('charset'));
            return true;
        }
    }

    function &_query($sql)
    {
        $query = $this->mysqli->query($sql);
        if ($query) {
            while ($row = $query->fetch_array()) {
                $result[] = $row;
            }
			unset($query);
            return $result;
        } else {
        	unset($query);
            return $result;
        }
    }

    function close()
    {
        return mysqli_close($this->mysqli);
    }

    function _exec($sql)
    {
        return $this->mysqli->query($sql);
    }

    function rollBack()
    {
        return $this->mysqli->rollback();
    }

    function commit()
    {
        return $this->mysqli->commit();
    }

    function beginTransaction()
    {
        return $this->mysqli->autocommit(false);
    }
}