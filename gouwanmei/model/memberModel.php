<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * memberModel Class  用户表模型
 * User: PGF
 * Date: 2015/12/3
 * Time: 10:56
 */
Class memberModel extends Model{
    private $allowField = array(
        'username','nickername','email','sex','birthday','qq','mobile','password'
    );

    /**
     * 获取加密后的密码以及盐值
     * @param $password     密码
     * @return array
     */
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

    /**
     * 用户登录
     * @param $username 用户名
     * @param $password 密码
     */
    public function login($username,$password){
        $username = $this->addslashes($username);
        $password = $this->addslashes($password);
        $suser = $this->where('username',$username)->getOne();
        if(empty($suser))
            return false;
        $password = md5($password.$suser['encrypt']);
        if($password==$suser['password']){
            $suser['lastlogin'] = time();$suser['lastip']=ip();
            $update=array(
                'lastlogin' => $suser['lastlogin'],
                'lastip'    => $suser['lastip']
            );
            $this->where('userid',$suser['userid'])->update($update);
            if(!$suser['nickername'])
                $suser['nickername'] = $suser['username'];
            return $suser;
        }else{
            return false;
        }
    }

    /**
     * 获取用户信息
     * @param $username
     * @return mixed
     */
    public function getUser($username){
        $username = $this->addslashes($username);
        return $this->where('username',$username)->getOne();
    }


    /**
     * 用户注册
     * @param $user     用户信息
     * @return int      错误代码
     */
    public function register($user){
        $user = $this->addslashes($user);

        ######### 会删除掉无用的字段 ########
        foreach($user as $field=>$v){
            if(!in_array($field,$this->allowField)){
                unset($user[$field]);
            }
        }
        $validate = Loader::plugin('validate');
        if(!$validate->check($user['username'],'username'))
            return 5;
        if(!$validate->check($user['password'],'password')) {
            return 6;
        }
        if(isset($user['nickername']))
        {
            if(!$validate->check($user['nickername'],'nickername'))
                return 7;
        }
        if(isset($user['email']))
        {
            if(!$validate->check($user['email'],'email'))
               return 8;
        }
        if(!isset($user['birthday'])||is_null($user['birthday']))
            $user['birthday'] = date("Y-m-d");
        $suser = $this->getUser($user['username']);
        if(!empty($suser))
            return 3;
        $encpass = $this->encpass($user['password']);
        $user['password'] = $encpass['password'];
        $user['encrypt']  = $encpass['encrypt'];
        $user['regtime']  = time();
        $user['lastlogin'] = time();
        if($this->insert($user)){
            return 0;
        }else{
            return 1;
        }
    }

    /**
     * @param $user          要修改的用户信息
     * @param $userid        用户ID
     * @return bool OR int   状态或者错误码
     */
    public function edit_profile($user,$userid){
        $user = $this->addslashes($user);
        $validate = Loader::plugin('validate');

        ######### 会删除掉无用的字段 ########
        foreach($user as $field=>$v){
            if(!in_array($field,$this->allowField)){
                unset($user[$field]);
            }
        }
        if(isset($user['nickername']))
            if(!$validate->check($user['nickername'],'nickername'))
                return 1;       //昵称不合法
        if(isset($user['email']))
            if(!$validate->check($user['email'],'email'))
                return 2;       //邮箱不合法
        if(isset($user['qq']))
            if(!$validate->check($user['qq'],'qq'))
                return 3;       //qq号码不合法
        if(isset($user['mobile']))
            if(!$validate->check($user['mobile'],'mobile'))
                return 4;       //手机号码不正确
        if($this->where('userid',$userid)->update($user)){
            return 0;
        }else{
            return -1;
        }
        return true;
    }


}