<?php
if (!defined('__ROOT__')) exit('Sorry,Please from entry!');
/**
 * Created by PhpStorm.
 * User: PGF
 * Date: 2015/12/1
 * Time: 9:13
 */

/**
 * Class tagsModel 标签操作模型
 * 这一块暂停，目前实现遇到问题
 * 犹豫效率
 */

/*
 *   tagid	int(10)	否
 *   tagname	varchar(52)	否
 *   tagcount	int(11)	是 	0
 */
CLASS tagsModel EXTENDS Model{
    private $is_tag=array();
    /**
     * @param $tagname
     */
    public function add($tagname)
    {
        if (is_array($tagname)) {
            foreach($tagname as $tag){
                $this->add($tag);
            }
        } else {
            $tagname = $this->addspashes($tagname);
            $insert = array(
                'tagname' => $tagname
            );
            return $this->insert($insert);
        }
    }

    /**
     * @param $tagname String   TAG名
     */
    public function is_tag($tagname){

    }

    /**
     * @param $tagname
     * @param int $num  要变动的数量
     */
    public function update($tagname,$num=+1){

    }
}