<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');

/**
 * Created by PhpStorm.
 * memberModule Class
 * User: PGF
 * Date: 2015/12/4
 * Time: 15:07
 */
class memberModule
{
    private $user=false;
    private $tokenType='COOKIE';

    /**
     * 获取Token
     * @param $user
     */
    public function getToken($user){
        $user['username'] = base64_encode($user['username']);
        $token=array(
            'member_user' => $user['username'],
            'member_token'=> md5($user['username'].$user['password'].$user['lastlogin'])
        );
        return $token;
    }

    /**
     * 保存登录Token
     * @param $user                 用户信息
     * @param string $tokenType     Token存放类型
     */
    public function saveToken($user, $tokenType = 'COOKIE'){
        if($tokenType=='COOKIE'){
            $token = $this->getToken($user);
            setcookie('member_user', $token['member_user'] , time()+60*60*24*30);
            setcookie('member_token', $token['member_token'] , time()+60*60*24*30);
        }elseif($tokenType=='SESSION'){
            $token = $this->getToken($user);
            $_SESSION['member_user']  = $token['member_user'];
            $_SESSION['member_token'] = $token['member_token'];

        }
    }

    /**
     * 验证是否登陆 如果登陆过 则会返回用户信息
     * @param string $tokenType
     */
    public function isLogin($tokenType='COOKIE')
    {
        if (!$this->user) {
            if ($tokenType == 'COOKIE') {
                $this->tokenType = $tokenType;
                if (isset($_COOKIE['member_user']) && isset($_COOKIE['member_token'])) {
                    $username = base64_decode($_COOKIE['member_user']);
                    $user = Model('member')->getUser($username);
                    if (!$user) {
                        return false;
                    } else {
                        $token = $this->getToken($user);
                        if ($token['member_token'] == $_COOKIE['member_token']) {
                            if(!$user['nickername'])
                                $user['nickername'] = $user['username'];
                            return $this->user = $user;
                        } else {
                            return false;
                        }
                    }
                }
            } elseif($tokenType == 'SESSION') {
                $this->tokenType = $tokenType;
                if (isset($_SESSION['member_user']) && isset($_SESSION['member_token'])) {
                    $username = base64_decode($_SESSION['member_user']);
                    $user = Model('member')->getUser($username);
                    if (!$user) {
                        return false;
                    } else {
                        $token = $this->getToken($user);
                        if ($token['member_token'] == $_SESSION['member_token']) {
                            if(!$user['nickername'])
                                $user['nickername'] = $user['username'];
                            return $this->user = $user;
                        } else {
                            return false;
                        }
                    }
                }
            }
        }else{
            return $this->user;
        }
    }

    /**
     * 退出登录操作
     */
    public function logout(){
        if($this->tokenType=='COOKIE'){
            setcookie('member_user', '' , time());
            setcookie('member_token', '' , time());
        }else{
            unset($_SESSION['member_user']);
            unset($_SESSION['member_token']);
        }
    }
}