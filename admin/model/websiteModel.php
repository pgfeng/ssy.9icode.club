<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * User: PGF
 * Date: 2015/6/02
 * Time: 02:36
 */
class websiteModel extends Model
{
    public function set($setting, $siteid)
    {
        $setting = $this->addslashes($setting);
        $ssetting = array(                      //要修改数据库的字段
            'title' => $setting['title'],
            'keywords' => $setting['keywords'],
            'description' => $setting['description'],
            'template' => $setting['template'],
            'registercheckcode' => $setting['registercheckcode'],
            'logincheckcode'    => $setting['logincheckcode'],
            'membertokentype'   => $setting['membertokentype']
        );
        if($ssetting['template']!=Config::cms('view_name')||$setting['view_cache']!=Config::cms('view_cache')||$setting['view_cache_time']!=Config::cms('view_cache_time')){
            $uset=array(                        //修改config的配置
                'view_name'     => $ssetting['template'],
                'view_cache'    => $setting['view_cache'],
                'view_cache_time'=> $setting['view_cache_time']
            );
            config::set($uset,'cms',1);
        }

        return $this->where('siteid', 1)->update($ssetting);
    }
}