<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
class mysql extends Db
{
    private $con = false;

    function connect()
    {
        $con = @mysql_connect(Config::database('host') . ':' . Config::database('port'), Config::database('user'), Config::database('pass'));
        if ($con) {
            $r = mysql_select_db(Config::database('name'), $con) or Debug::add('连接数据库失败：<font color=red>' . mysql_error() . '</font>');
            if ($r === true) {
                $this->con = $con;
                $this->exec('set names ' . Config::database('charset'));
                return true;
            }
        } else {
            Debug::add('连接Mysql服务器失败：,' . mysql_error());
        }
        return false;
    }

    function _query($sql)
    {
        $query = mysql_query($sql, $this->con);
        if ($query) {
            $result = array();
            while ($row = mysql_fetch_array($query)) {
                $result[] = $row;
            }
            return $result;
        }
    }

    function _exec($sql)
    {
        return mysql_query($sql, $this->con);
    }

    function commit()
    {
        return $this->exec("commit");
    }

    function rollBack()
    {
        return $this->exec("rollback");
    }

    function beginTransaction()
    {
        $this->exec("set autocommit=0");
    }

}
