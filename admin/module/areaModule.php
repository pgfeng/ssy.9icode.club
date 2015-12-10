<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * User: PGF
 * Date: 2015/10/5
 * Time: 9:42
 */
class areaModule{
    public function province(){
        $provinces = model('area_province')->query();
        $data = array();
        foreach($provinces as $province){
            $data[] = array(
                'pid'   => $province['provinceid'],
                'name'  => $province['provincename']
            );
            unset($province);
        }
        unset($provinces);
        return json_encode($data);
    }

    public function city($provinceid = 1){
        $citys = model('area_city')->where('provinceid',intval($provinceid))->query();
        $data = array();
        foreach($citys as $city){
            $data[] = array(
                'cid'   => $city['cityid'],
                'name'  => $city['cityname']
            );
            unset($city);
        }
        unset($citys);
        return json_encode($data);
    }

    public function district($cityid = 1){
        $districts = model('area_district')->where('cityid',intval($cityid))->query();
        $data = array();
        foreach($districts as $district){
            $data[] = array(
                'cid'   => $district['districtid'],
                'name'  => $district['districtname']
            );
            unset($district);
        }
        unset($districts);
        return json_encode($data);
    }
}