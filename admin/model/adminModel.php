<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * User: PGF
 * Date: 2015/5/22
 * Time: 15:58
 */
class adminModel extends Model
{
    /**
     * @param $username         管理员用户名
     * @param $passwrod         管理员密码
     * @param int $roleid 管理员权限
     * @param string $email 管理员邮箱
     * @return bool
     */
    public function addadmin($username, $passwrod, $roleid = 2, $email = '', $realname='')
    {
        $passwrod = $this->encpass($passwrod);
        $admin = array(
            'username' => $username,
            'password' => $passwrod['password'],
            'roleid' => $roleid,
            'encrypt' => $passwrod['encrypt'],
            'email' => $email,
            'realname' => $realname
        );
        return $this->insert($admin);
    }

    public function encpass($password)
    {
        $encrypt = $this->encrypt(6);
        return array(
            'encrypt' => $encrypt,
            'password' => md5($password . $encrypt)
        );
    }

    /**
     * 随机密钥
     * @param $num  密钥长度
     * return String
     */
    private function encrypt($num)
    {
        //63个随机字
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_';
        $encrypt = '';
        for ($i = 0; $i < $num; $i++) {
            $encrypt .= $str[rand(0, 62)];
        }
        return $encrypt;
    }

    public function deladmin($userid)
    {
        if ($userid > 1) {
            return $this->where('userid', intval($userid))->delete();
        }
        return false;
    }

    /**
     * 登录
     * @param $username
     * @param $password
     * @param $checkcode
     * @return array
     */
    public function login($username, $password, $checkcode)
    {
        $msg = array(
            'status' => false,
            'msg' => '请认真输入'
        );
        if (!isset($_SESSION['code']) || strtolower($checkcode) != $_SESSION['code']) {
            $msg['status'] = false;
            $msg['msg'] = '验证码错误';
            unset($_SESSION['code']);
            return $msg;
        }
        $user = $this->where('username', $this->addslashes($username))->select()->query();
        if (!empty($user)) {
            if (md5($password . $user[0]['encrypt']) != $user[0]['password']) {
                $msg['status'] = false;
                $msg['msg'] = '密码错误';
            } else {
                $msg['status'] = true;
                $_SESSION['adminuser'] = $user[0]['username'];
                $_SESSION['loginKey'] = $this->loginkey($user[0]['username'], $user[0]['password']);
                $update = array(
                    'lastloginip' => ip(),
                    'lastlogintime' => time()
                );
                $this->where('username', $this->addslashes($username))->update($update);
            }
            unset($_SESSION['code']);
            return $msg;
        } else {
            $msg = array(
                'status' => false,
                'msg' => '用户名错误'
            );
            unset($_SESSION['code']);
            return $msg;
        }
    }

    /**
     * @param $username //管理员用户名
     * @param $password //管理员密码
     * @return string       //加密过的字符串
     */
    private function loginkey($username, $password)
    {
        return md5($username . $password);
    }

    /**
     * 注销
     * @return bool
     */
    public function loginout()
    {
        if (isset($_SESSION['loginKey'])) {
            unset($_SESSION['loginKey']);
            unset($_SESSION['adminuser']);
        }
        return true;
    }

    /**
     * 判断是否登录
     * 已登录，返回用户信息
     * 未登录，返回false
     * @return bool
     */
    public function checklogin()
    {
        if (!isset($_SESSION['loginKey']) || !isset($_SESSION['adminuser']))
            return false;
        $user = $this->where('username', $this->addslashes($_SESSION['adminuser']))->select()->leftjoin('admin_role', 'admin.roleid', 'admin_role.roleid')->limit(1)->query();
        if (empty($user))
            return false;
        elseif ($this->loginkey($user[0]['username'], $user[0]['password']) == $_SESSION['loginKey']) {
            return $user;
        } else
            return false;
    }

    /**
     * @param $userid //管理员ID
     * @param $user //要修改的管理员信息
     */
    public function edit($userid, $user)
    {
        $user = $this->addslashes($user);
        $pass = $this->encpass($user['password']);
        $user['password'] = $pass['password'];
        $user['encrypt'] = $pass['encrypt'];
        return $this->where('userid', intval($userid))->update($user);
    }

    /**
     * 查找指定的管理员
     * @param $username
     */
    public function selectuser($username)
    {
        return $this->where('username', $this->addslashes($username))->select()->limit(1)->query();
    }
}