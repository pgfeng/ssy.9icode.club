<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');

/**
 * Created by PhpStorm.
 * User: PGF
 * Date: 2015/7/15
 * Time: 16:35
 */

abstract class Session{

    private $isOpen;

    public function __construct(){

        if(!$this->isOpen) {

            ini_set('session.name','SESSION');
            
            session_set_save_handler(
                array($this, 'open'),
                array($this, 'close'),
                array($this, 'read'),
                array($this, 'write'),
                array($this, 'destroy'),
                array($this, 'gc')
            );

            session_start();

            //register_shutdown_function('session_write_close');

            $this->isOpen = true;

        }

    }

    public function open($save_path, $session_name){

        return $this->_open();

    }

    public function close(){
        return $this->_close();
    }

    public function read($id){

        return $this->_read($id);

    }

    public  function write($id, $data){

        return $this->_write($id,$data);

    }

    public function destroy($id = false){

        return $this->_destroy($id);

    }

    public function gc($maxlifetime){

        return $this->_gc($maxlifetime);

    }

    abstract function _open();

    abstract function _close();

    abstract function _read($id);

    abstract function _write($id, $data);

    abstract function _destroy($id);

    abstract function _gc($maxlifetime);
}
//====================    END Session.class.php      ========================//