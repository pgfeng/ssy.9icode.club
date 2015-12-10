<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * User: PGF
 * Date: 2015/5/25
 * Time: 9:14
 */
class admin_roleModel extends Model
{
    public function edit($role)
    {
        $role = $this->addslashes($role);
        if (isset($role['roleid']))
            return $this->where('roleid', $role['roleid'])->update($role);
        else
            return false;
    }

    /**
     * 添加角色
     * @param $role
     * @return bool
     */
    public function add($role)
    {
        $role = $this->addslashes($role);
        if (isset($role['rolename'])) {
            if ($this->insert($role)) {
                $roleid = $this->select("max(roleid)")->query();
                return $roleid[0][0];
            }
        } else
            return false;
    }

    /**
     * 删除角色
     * @param $roleid
     * @return bool
     */
    public function del($roleid)
    {
        if ($roleid != 1)
            return $this->where('roleid', $this->addslashes($roleid))->delete();
        return false;
    }

    /**
     * 修改角色权限
     * @param $rolearr  存放id的数组
     * @return bool
     */
    public function editrole($roleid, $menuarr)
    {
        $menuarr = explode(',', $menuarr);
        $admin_role_priv = model('admin_role_priv');
        $admin_role_priv->where('roleid', intval($roleid))->delete();
        foreach ($menuarr as $m) {
            if (!empty($m)) {
                $insert = array(
                    'roleid' => $roleid,
                    'menuid' => $m
                );
                $admin_role_priv->insert($insert);
            }
        }
        return true;
    }
}