<?php

class categoryModel extends Model{
    /**
     * 获取栏目下的子栏目，为0时获取全部
     */
    public function get_category($catid=0){
        $category=$this->where('parent',$catid)->query();
        foreach($category as $cate){
            $cate['children']=!empty($cate['children'])?unserialize($cate['children']):array();
            if(!empty($cate['children'])){
                $category['children']=$this->get_category($cate['cid']);
            }
        }
        return $category;
    }
    public function search($keywords){
        $keywords = $this->addslashes($keywords);
        return $this->where('catname like "%'.$keywords.'%"')->orwhere('cid like "%'.$keywords.'%"')->select('catname,cid')->query();
    }
    /**
     * 删除栏目，将会删除栏目下所有的栏目和内容
     * @param $cid
     * @return bool
     */
    public function del($cid){
        $cid=intval($cid);
        $res=$this->where('cid',$cid)->leftJoin('model','category.cat_modelid','model.modelid')->getOne();
        if(empty($res)){
            return false;
        }else {
            if ($res['parent'] > 0)
                $this->push_category_child($res['parent'], $cid);             //从父级删除当前子栏目
            if($res['contable']!='')
                $ret = model($res['contable'])->where('cid', $res['cid'])->delete();
            if ((isset($ret)&&$ret!==false)||$res['is_page']==1) { //先删除内容
                if (model($res['catetable'])->where('id', $res['catid'])->delete()!==false) {
                    if ($res['children'] != null) {
                        $children = unserialize($res['children']);
                        foreach ($children as $ccid) {
                            if (!$this->del($ccid)) {
                                return false;
                            }
                        }
                        //**删除栏目下的内容
                        return $this->where('cid', $cid)->delete();
                    } else {
                        return $this->where('cid', $cid)->delete();
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
    /**
     * 从一个栏目中移除一个子栏目
     * @param $parentid
     * @param $childid
     */
    public function push_category_child($parentid,$childid){
        $children = model('category')->where('cid',$parentid)->getOne('children');
        $children = $children[0];
        $children = unserialize($children);
        if(in_array($childid,$children)) {
            foreach ($children as $k => $id) {
                if ($id == $childid) {
                    unset($children[$k]);
                }
            }
            model('category')->where('cid',$parentid)->update(array('children'=> serialize($children)));
        }
    }
}