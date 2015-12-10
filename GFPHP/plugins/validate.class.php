<?php
/**
 * Created by PhpStorm.
 * User: PGF
 * Class validate 表单验证 包含常用正则
 * Date: 2015/9/9
 * Time: 15:24
 */
class validate
{
    /**
     * 使用正则验证数据
     * @access public
     * @param string $value 要验证的数据
     * @param string $rule 验证规则
     * @return boolean
     */
    public function check($value, $rule)
    {
        $validate = array(
            #不能为空
            'require'       => '/.+/',
            #邮箱
            'email'         => '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',
            #网址
            'url'           => '/^http(s?):\/\/(?:[A-za-z0-9-]+\.)+[A-za-z]{2,4}(?:[\/\?#][\/=\?%\-&~`@[\]\':+!\.#\w]*)?$/',
            #价格
            'currency'      => '/^\d+(\.\d+)?$/',
            #数字
            'number'        => '/^\d+$/',
            #邮编
            'zip'           => '/^\d{6}$/',
            #整数
            'integer'       => '/^[-\+]?\d+$/',
            #浮点数
            'double'        => '/^[-\+]?\d+(\.\d+)?$/',
            #英语单词
            'english'       => '/^[A-Za-z]+$/',
            #验证汉字
            'chinese'       => '^[\u4e00-\u9fa5]+$',
            #QQ号码
            'qq'            => '/^[1-9]\d{4,10}$/',
            #验证手机号码
            'mobile'        => '/^1[3458][0-9]{9}$/',
            #用户名 常用正则
            'username'      => '/^[a-zA-Z0-9_]{3,15}$/',
            #密码  常用正则   不能包含空白符 并且在4-16
            'password'      => function() use ($value){
                $len = strlen($value);
                if($len>16||$len<4)
                    return false;
                if(strpos($value,' ',0)>0){
                   return false;
                }else{
                   return true;
                }
            },
            #昵称 常用正则 中文字母数字下划线
            'nickername'    => '/^[\x80-\xff_a-zA-Z0-9]{0,16}$/'
        );
        // 检查是否有内置的正则表达式，如果不存在将作为正则处理
        if (isset($validate[strtolower($rule)])) {
            if(!is_string($validate[strtolower($rule)]))
                return $validate[strtolower($rule)];
            else
                $rule = $validate[strtolower($rule)];
        }else{
            if(!is_string($validate[strtolower($rule)]))
                return $validate[strtolower($rule)];
        }

        return preg_match($rule, $value) === 1;
    }

}