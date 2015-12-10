<?php
/**
 * Created by PhpStorm.
 * User: PGF
 * Date: 2015/11/19
 * Time: 9:41
 */

class member_groupModel extends Model{

    /**
     * @param $group array();
     * array('groupname'=>'','description'=>,'disabled'=>);
     */
    public function add($group){
        $group = $this->addslashes($group);
        $sgroup = $this->where('groupname',$group['groupname'])->getOne();      //获取相同组名
        if(empty($sgroup)){                                         //判断是否存在
            if($this->insert($group)!==false){
                $status = array(
                    'status' => 'success',
                    'msg'    => '添加成功'
                );
            }else{
                $status = array(
                    'status' => 'error',
                    'msg'    => '添加失败！请联系超级管理员！'
                );
            }
        }else{
            $status = array(
                'status' => 'info',
                'msg'    => '您要添加的用户组已存在，请更换！'
            );
        }
        return $status;
    }

    /**
     * @param $groupid  用户组的ID  如果为数组则会删除多个
     */
    public function del($groupid){
        if(is_array($groupid)){
            foreach($groupid as $id){
                $this->del($id);
            }
        }else{
            if($groupid!=''){
                $this->where('groupid',intval($groupid))->delete();
            }
        }
        return;
    }

    /**
     * @param $group        同add里的group参数
     * @param $groupid      用户组ID
     * @return mixed
     */
    public function edit($group){
        $group = $this->addslashes($group);
        $groupid = intval($group['groupid']);
        $sG = $this->where('groupid',$groupid)->getOne();
        $status = array(
                'status' => 'error',
                'msg'    => '你要修改的用户组并不存在！'
            );
        if(empty($sG))
            return $status;
        else{
            if($this->where('groupid',$groupid)->update($group)===false){
                $status = array(
                    'status' => 'error',
                    'msg'    => '用户组信息更新失败！'
                );
            }else {
                $status = array(
                    'status' => 'success',
                    'msg' => '用户组信息更新成功！'
                );
            }
            return $status;
        }
    }
}