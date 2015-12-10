<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
class PdoDriver extends db
{
    private $db;

    public function connect()
    {
        try {
            $this->db = new pdo(config::database('DSN'), Config::database('user'), Config::database('pass'));
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        } catch (PDOException $e) {
            Debug::add('<font color="red">' . $e->getMessage() . '</font>');
        }
        if (!$this->db)
            return false;
        else {
            $this->exec('set names ' . Config::database('charset'));
            return true;
        }

    }

    public function _query($sql)
    {
        $query = $this->db->query($sql);
        $result = array();
        while ($fetch = $query->fetch()) {
            $result[] = $fetch;
        }
		unset($query);
        return $result;

    }

    public function _exec($sql)
    {
        return $this->db->exec($sql);
    }

    public function beginTransaction()
    {
        $this->db->beginTransaction();
    }

    public function commit()
    {
        $this->db->commit();
    }

    public function rollBack()
    {
        $this->db->rollBack();
    }

    public function close()
    {

    }
}
