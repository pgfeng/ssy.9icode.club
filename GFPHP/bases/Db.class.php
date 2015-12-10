<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');

/**
 * SQL语句处理类
 * 提供简单的SQL语句构造方法
 * 数据库驱动类需要继承此类
 * 用最少的代码做最不可能的事   @PGF
 * 创建时间：2014-08-06 14:20 PGF
 * 修改时间：2014-08-18 15:20 PGF 修改增删改查方法，同时支持链式操作和简易操作
 * 修改时间：2014-08-11 13:18 PGF 默认操作表名，使用模型时直接默认表名，增加简易型
 * 修改时间：2014-08-13 22:12 PGF 修改SELECT&UPDATE&DELETE&INSERT方法，使调用后立即执行语句
 * 修改时间：2015-02-25 17:08 PGF SELECT不在自动执行，需query()方法执行，方便多表操作
 * 修改时间：2015-06-14 11:02 PGF 修改select存在表名时自动加上表前缀
 */

/**
 * 本类所有表名字段名为了符合大部分数据库的SQL规范字段未加转义符号
 * 构造数据库时请注意所使用的数据库的保留字
 */
abstract class Db
{
    public $table = '';
    public $section = array(
        'handle'    => 'select',
        'select'    => '*',
        'insert'    => '',
        'set'       => '',
        'where'     => '',
        'join'      => '',
        'group'     => '',
        'orderby'   => '',
        'limit'     => ''
    );
    public $sql = '';

    /**
     * 转义函数
     * 参数可以为多参数或数组，返回数组
     */
    public static function addslashes(&$var)
    {
        if (func_num_args() > 1) {
            $args = func_get_args();
            for ($i = 0; $i < func_num_args(); $i++) {
                $args[$i] = self::addslashes($args[$i]);
            }
            return $args;
        }
        if (!@get_magic_quotes_gpc()) {
            if (is_array($var)) {
                foreach ($var as $k => &$v) {
                    self::addslashes($v);
                }
            } else {
                $var = addslashes($var);
            }
            return $var;
        }
        return $var;
    }

    public static function stripslashes(&$var)
    {
        if (func_num_args() > 1) {
            $args = func_get_args();
            for ($i = 0; $i < func_num_args(); $i++) {
                $args[$i] = self::stripslashes($args[$i]);
            }
            return $args;
        }
        if (!@get_magic_quotes_gpc()) {
            if (is_array($var)) {
                foreach ($var as $k => &$v) {
                    self::stripslashes($v);
                }
            } else {
                $var = stripslashes($var);
            }
            return $var;
        }
        return $var;
    }

    /**
     * 设置查询
     * 参数为一个时设置查询字段
     * 当为多个时可看成
     * SELECT($table,$where,$orderby,$limit,$column);
     */
    final function select($select = '*')
    {
        $this->section['handle'] = 'select';
        $arg_num = func_num_args();
        $arg_num = $arg_num > 5 ? 5 : $arg_num;
        if ($arg_num > 1) {
            $arg_list = func_get_args();
            for ($i = 0; $i < $arg_num; $i++) {

                switch ($i) {
                    case 0:
                        $this->table($arg_list[$i]);
                        break;
                    case 1:
                        $this->where($arg_list[$i]);
                        break;
                    case 2:
                        $this->orderby($arg_list[$i]);
                        break;
                    case 3:
                        $this->limit($arg_list[$i]);
                        break;
                    case 4:
                        $this->select($arg_list[$i]);
                        break;
                }
            }
            return $this->query();        //多参数将自懂执行query，返回数组；
            //return $this;
        } else {
            //==判断是否为数组
            if(is_array($select))
            {
                $allfield = '';
                foreach($select as $field){
                    if($allfield == '')
                    {
                        if(strpos($field,'.') !== false) {
                            //==自动加上表名前缀
                            $allfield = Config::database('table_pre') . $field;
                        }else{
                            $allfield = $field;
                        }
                    }else
                        if(strpos($field,'.') !== false) {
                            $allfield .= ','.Config::database('table_pre') . $field;
                        }else{
                            $allfield .= ','.$field;
                        }
                }
                $this->_set($allfield,'select');
            }else {
                    $this->_set($select, 'select');
            }
            //return $this->query();
            return $this;
        }
    }

    final function table($table, $forget = 1)
    {
        if ($forget == 0)
            $this->table = $table;
        $this->_set(Config::database('table_pre').$table, 'table');
        return $this;
    }

    final function _set($data, $type)
    {
        if (is_array($data)) {
            $this->section[$type] = implode(',', $data);
        } else {
            $this->section[$type] = $data;
        }
    }

    /**
     * 设置条件
     * 当参数是两个，第一个为字段名，第二个为值
     * 如果为数组，则是多个条件如array('条件一','条件二'.......);
     * @return Object $this
     */
    final function where($where)
    {
        if (func_num_args() == 2)
            $where = '' . func_get_arg(0) . '=' . "'" . func_get_arg(1) . "'";
        if (is_array($where))
            $where = implode(' and ', $where);
        if (isset($this->section['where']) && !empty($this->section['where']))
            $this->section['where'] .= ' and ' . $where;
        else
            $this->section['where'] = $where;
        return $this;
    }

    final function orderBy($orderby)
    {
        $this->section['orderby'] = Config::database('table_pre') . $orderby;
        return $this;
    }

    final function limit()
    {
        $arg_num = func_num_args();
        $arg_list = func_get_args();
        if ($arg_num == 1)
            $this->section['limit'] = $arg_list[0];
        if ($arg_num == 2)
            $this->section['limit'] = $arg_list[0] . ',' . $arg_list[1];
        return $this;
    }

    final function orwhere($where)
    {
        if (func_num_args() == 2)
            $where = '' . func_get_arg(0) . '=' . "'" . func_get_arg(1) . "'";
        if (is_array($where))
            $where = implode(' or ', $where);
        if (isset($this->section['where']) && !empty($this->section['where']))
            $this->section['where'] .= ' or ' . $where;
        else
            $this->section['where'] = $where;
        return $this;
    }

    final function from($from)
    {
        $this->table($from);
        return $this;
    }

    /**
     * 一个参数是设置修改内容
     * 多个参考下面参数使用
     * UPDATE($table, $set, $where, $limit)
     */
    final function update($update)
    {
        $this->section['handle'] = 'update';
        $this->clear_cache();
        $arg_num = func_num_args();
        $arg_num = $arg_num > 4 ? 4 : $arg_num;
        if ($arg_num > 1) {
            $arg_list = func_get_args();
            for ($i = 0; $i < $arg_num; $i++) {
                switch ($i) {
                    case 0:
                        $this->table($arg_list[$i]);
                        break;
                    case 1:
                        $this->_set($arg_list[$i], 'update');
                        break;
                    case 2:
                        $this->where($arg_list[$i]);
                        break;
                    case 3:
                        $this->limit($arg_list[$i]);
                        break;
                }
            }
            //print_r($this->section);
            return $this->exec();
        } else {

            $this->section['handle'] = 'update';
            if(is_string($update)){
                $this->_set($update, 'update');
                return $this->exec();
            }
            $keys = array_keys($update);
            if (in_array('0', $keys)) {
                $this->_set($update, 'update');
            } else {
                $values = array_values($update);
                $size = count($keys);
                $ud = null;
                for ($i = 0; $i < $size; $i++) {
                    if ($i != 0)
                        $ud .= ',';
                    $ud .= $keys[$i] . ' = \'' . $values[$i] . '\'';

                }
                $this->_set($ud, 'update');
            }
            return $this->exec();
        }
    }

    final function clear_cache()
    {
        return Cache::flush(Config::database('cache_dir') . '/' . $this->get_tatle());
    }

    final public function get_tatle()
    {
        return (isset($this->section['table']) && !empty($this->section['table'])) ? $this->section['table'] : Config::database('table_pre') . $this->table;
    }

    final function exec($sql = false)
    {
        if (!$sql)
            $this->compile();
        $sql = $sql ? $sql : $this->sql;
        Debug::add($sql, 2);
        $this->_reset();
        return $this->_exec($sql);
    }

    /**
     * 解析出完整的SQL命令
     * 返回解析好的SQL命令或者返回false
     * @return String or false
     */

    final function compile()
    {
        $this->section['table'] = $this->get_tatle();
        if ($this->section['handle'] == 'insert') {
            $this->sql = 'insert into ' . $this->section['table'] . ' ' . $this->section['insert'];
        } else {
            if ($this->section['handle'] == 'select')
                $sql = "{$this->section['handle']} {$this->section['select']} from {$this->section['table']}";
            elseif ($this->section['handle'] == 'update')
                $sql = "{$this->section['handle']} {$this->section['table']} set {$this->section['update']}";
            elseif ($this->section['handle'] == 'delete')
                $sql = "{$this->section['handle']} from {$this->section['table']}";
            if (!empty($sql)) {
                $sql .= ($this->section['join'] ? " " . $this->section['join'] : '') . ($this->section['where'] ? " where {$this->section['where']}" : '') . ($this->section['group'] ? " group by {$this->section['group']}" : '') . ($this->section['orderby'] ? " order by {$this->section['orderby']}" : '') . ($this->section['limit'] ? " limit  {$this->section['limit']}" : '');
                return $this->sql .= $sql;
            } else {
                echo $this->section['handle'] . 'method is undefined!';
            }
            return false;
        }

    }

    final function _reset()
    {
        $this->section = array(
            'handle' => 'select',
            'select' => '*',
            'insert' => '',
            'table' => $this->table,
            'set' => '',
            'where' => '',
            'join' => '',
            'group' => '',
            'orderby' => '',
            'limit' => ''
        );
        $this->sql = '';
    }

    /**
     * 一个参数时只设置插入内容
     * 多个参数参考下面函数
     * INSERT($table,$value)
     */
    final function insert($insert)
    {
        $this->section['handle'] = 'insert';
        $this->clear_cache();
        $arg_num = func_num_args();

        if ($arg_num > 1) {
            $arg_list = func_get_args();
            $this->table($arg_list[0])->insert($arg_list[1]);
            return $this->exec();
        } else {
            $this->section['insert'] = is_array($insert) ? '(' . implode(',', array_keys($insert)) . ') VALUES (' . '\'' . implode('\',\'', array_values($insert)) . '\'' . ')' : "VALUES('{$insert}')";
            return $this->exec();
        }
    }

    final function leftJoin($table, $on1, $on2)
    {
        return $this->join($table, $on1, $on2, 'left');
    }

    final function join($table, $on1, $on2, $ori)
    {
        $this->section['join'] = $ori . ' join ' . Config::database('table_pre') . $table . " on " . Config::database('table_pre') . $on1 . '=' . Config::database('table_pre') . $on2;
        return $this;
    }

    final function rightJoin($table, $on1, $on2)
    {
        return $this->join($table, $on1, $on2, 'right');
    }

    final function fullJoin($table, $on1, $on2)
    {
        return $this->join($table, $on1, $on2, 'full');
    }

    final function innerJoin($table, $on1, $on2)
    {
        return $this->join($table, $on1, $on2, 'inner');
    }

    final function union($all = false)
    {
        $handle = $this->section['handle'];
        $sql = $this->compile();
        $this->_reset();
        $this->sql = $sql;
        $this->section['handle'] = $handle;
        if ($all)
            $this->sql .= ' union all ';
        else
            $this->sql .= ' union ';
        return $this;
    }

    /**
     * 删除记录
     * 一个参数设置表名
     * 多个参数参考如下
     * DELETE($table, $where, $orderby, $limit)
     */
    final function delete($delete = false)
    {
        $this->section['handle'] = 'delete';
        $this->clear_cache();
        $arg_num = func_num_args();
        $arg_list = func_get_args();
        $arg_num = $arg_num > 4 ? 4 : $arg_num;
        if ($arg_num > 1) {
            for ($i = 0; $i < $arg_num; $i++) {
                switch ($i) {
                    case 0:
                        $this->table($arg_list[0]);
                        break;
                    case 1:
                        $this->where($arg_list[1]);
                        break;
                    case 2:
                        $this->orderby($arg_list[2]);
                        break;
                    case 3:
                        $this->limit($arg_list[3]);
                        break;

                }
            }
            return $this->exec();
        }
        if ($delete)
            $this->table($delete);
        return $this->exec();
    }

    final function group($group)
    {
        $this->section['group'] = $group;
        return $this;
    }

    final public function version()
    {
        $version = $this->query('select VERSION()');
        return $version[0][0];
    }

    /**
     * @param $field  字段名
     * @return int    获取到的数量
     */
    public function count($field='*')
    {
        $this->select('count('.$field.')')->limit(1);
        $count = $this->query();
        return !empty($count) ? $count[0][0] : 0;
    }

    /**
     * 获取一条数据
     * @return bool or array
     */
    public function getOne($field='*'){
        $this->select($field);
        $this->limit(0,1);
        $fetch=$this->query();
        if(empty($fetch))
            return false;
        else
            return $fetch[0];
    }
    final public function query($sql = false)
    {
        if (!$sql) {
            $this->compile();
        }

        $sql = $sql ? $sql : $this->sql;
        //print_r($this);
        //echo Config::database('table_pre').Config::cache('table');
        if (Config::database('cache') && preg_match('/^SELECT/i', $sql) && ( Config::database('table_pre').Config::cache('table') != $this->table || Config::cache('driver')!='dbCache')) {
            //echo '开启缓存';
            if (!Cache::is_cache(md5($sql), (Config::database('cache_dir') . '/' . $this->section['table']))) {
                $data = $this->_query($sql);
                $cdata = '<?php exit;/*' . serialize($data) . '*/';
                Cache::set(md5($sql), $cdata, (Config::database('cache_dir') . '/' . $this->section['table']));
                //Cache::$cache->writeCache($sql,$data,(Config::database('cache_dir').'/'.$this->section['table']));
                Debug::add('DB:Update Cache ' . $sql, 2);
            } else {
                //$data=Cache::$cache->readCache($sql,(Config::database('cache_dir').'/'.$this->section['table']));
                $data = unserialize(substr(Cache::get(md5($sql), (Config::database('cache_dir') . '/' . $this->section['table'])), 13, -2));
                //exit();
                Debug::add('DB:Read Cache' . $sql, 2);
            }
            $this->_reset();
            if ($data == null)         //防止直接返回Null
                $data = array();
            return $data;
        } else {

            Debug::add($sql, 2);
            $this->_reset();
            $data = $this->_query($sql);
            if ($data == null)         //防止直接返回Null
                $data = array();
            return $data;
        }
    }            //链接数据库方法

    abstract function _query($sql);         //返回值是查询出的数组

    /**
     * 数据库驱动必须创建下列方法
     * 并且必须返回正确的值
     */

    abstract function _exec($sql);           //执行SQL

    abstract function connect();            //返回处理后的语柄

    abstract function beginTransaction();   //开启事务

    abstract function commit();             //关闭事务

    abstract function rollBack();           //开启回滚
}
//====================    END DB.class.php      ========================//