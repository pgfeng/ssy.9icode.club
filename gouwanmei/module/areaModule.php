<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * 地区 Module
 * User: PGF
 * Date: 2015/10/5
 * Time: 9:42
 */
class areaModule{
    /**
     * 获取省份
     * @return array
     */
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
        return $data;
    }

    /**
     * 获取城市
     * @param int $provinceid   省份的ID
     * @return array
     */
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
        return $data;
    }

    /**
     * 获取县区
     * @param int $cityid   上级城市的ID
     * @return array
     */
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
        return $data;
    }

    /**
     * 获取省份名
     * @param int $provinceid  省份ID
     */
    public function getProvince($provinceid = 1){
        $provinceid = intval($provinceid);
        $province = model('area_province')->where('provinceid', $provinceid)->getOne('provincename');
        return $province[0];
    }

    /**
     * 获取城市名
     * @param int $cityid     城市ID
     */
    public function getCity($cityid = 1){
        $cityid = intval($cityid);
        $city = model('area_city')->where('cityid', $cityid)->getOne('cityname');
        return $city[0];
    }

    /**
     * 获取县区名称
     * @param int $district
     */
    public function getDistrict($districtid = 1){
        $districtid = intval($districtid);
        $district = model('area_district')->where('districtid',$districtid)->getOne('districtname');
        return $district[0];
    }
}