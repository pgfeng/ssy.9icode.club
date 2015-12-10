<?php
/**
 * Created by PhpStorm.
 * User: PGF
 * Class cmsPage CMS中常用的分页样式
 * Date: 2015/9/9
 * Time: 15:24
 */
class cmsPage{
    private $url;                            //url地址	如：index.html?page=标记
    private $total;                            //总记录数
    private $listnum;                        //页面记录数
    private $page;                            //当前page值
    private $pageNum;                        //总页面数
    private $phtml;                          //页面分页html
    /**
     * 分页构造方法
     * @param Int $total 总记录数
     * @param String $url 网址，需要包含标记，参考$this->config['mark']
     * @param Int $page 当前分页值
     * @param int $listnum 每页显示的记录数
     * @param int $mark     分页标记 比如给的url值是index.html?page=%page% ，得到的结果就是index.html?page=页面数值 一般情况下不需要给值
     */
    public function init($total, $url = '', $page = 1, $listnum = 10, $mark = '%page%')
    {
        //echo $page;exit;
        $this->url = $url;
        $this->page = $page >= 1 ? intval($page) : 1;
        $this->total = $total;
        $this->listnum = $listnum;
        $pageNum = ceil($total / $listnum);
        $this->pageNum = $pageNum >= 1 ? intval($pageNum) : 1;
        $this->mark = $mark;
        if($this->page>$pageNum)        //如果当前页面数超过了总页面数，那么当前页面就是最后一个页面
            $this->page = $pageNum;
    }
    //====替换标记
    private function replace_page($num)
    {
        return str_replace($this->mark, $num, $this->url);
    }
    //===== 下面为实现分页样式的方法，也可以自己去添加方法
    /**
     * 只有上一页和下一页
     */
    public function Simple(){
        //可以在这里修改样式
        $ul_class='am-pagination blog-pagination';
        $li_pri_class='am-pagination-prev';
        $li_nex_class='am-pagination-next';
        $prevTxt = '« 上一页';
        $nextTxt = '下一页 »';

        if($this->pageNum>1){
            $this->phtml='';
            if($this->page>1){
                $prevUrl = $this->replace_page($this->page-1);
                $this->phtml.='<li class="'.$li_pri_class.'"><a href="'.$prevUrl.'">'.$prevTxt.'</a></li>';
            }
            if($this->page<$this->pageNum){
                $nextUrl = $this->replace_page($this->page+1);
                $this->phtml.='<li class="'.$li_nex_class.'"><a href="'.$nextUrl.'">'.$nextTxt.'</a></li>';
            }
            if($this->phtml!=''){
                $this->phtml='<ul class="'.$ul_class.'">'.$this->phtml.'</ul>';
            }
        }else{
            $this->phtml='';
        }
    }
    /**
     * 只显示相近的几个和上页下页  类似于 《 4 5 6 7 8 9 10 》
     */
    public function roll(){
        $ul_class       = 'pglist';
        $active_class   = 'on';
        $lists_class    = '';
        $disabled_class = 'disabled';
        $btn_nums       = 0;
        $prev           = '上一页';
		$prev_class     = 'last';
        $next           = '下一页';
		$next_class     = 'next';
        $first          = '首页';
		$first_class    = 'home';
        $last           = '尾页';
		$last_class     = 'over';
        $hasFirstLast   = true;
        $p = $this->pageNum > $btn_nums ? $btn_nums : $this->pageNum;
        if($this->pageNum==1){
            return;
        }
        $this->phtml = '<ul class="' . $ul_class . '">';
        $html ='';
        if ($this->page > 1) {
            $html .= '<li class="'.$prev_class.'"><a href="' . $this->replace_page($this->page - 1) . '">' . $prev . '</a></li>';
        } else {
            $html .= '<li class="'.$prev_class . ' ' . $disabled_class . '"><a href="javascript:void(0);">' . $prev . '</a></li>';
        }

        $btn_nums_2 = floor($btn_nums / 2);
        if (($this->page - $btn_nums_2) >= 1 && ($this->pageNum - $btn_nums_2) >= $this->page) {
            for ($i = 0; $i < $p; $i++) {
                $ii = ($this->page - $btn_nums_2) + $i;
                $class = $ii == $this->page ? $active_class : '';
                $html .= '<li class="' . $class . '"><a href="' . $this->replace_page($ii) . '">' . $ii . '</a></li>';
            }

        } else {
            if ($this->page < $btn_nums) {
                for ($i = 0; $i < $p; $i++) {
                    $ii = $i + 1;
                    $class = $ii == $this->page ? $active_class : '';
                    $html .= '<li class="' . $class . '"><a href="' . $this->replace_page($ii) . '">' . $ii . '</a></li>';
                }
            } else {
                for ($i = 0; $i < $p; $i++) {
                    $ii = ($this->pageNum - ($btn_nums - 1)) + $i;
                    $class = $ii == $this->page ? $active_class : '';
                    $html .= '<li class="' . $class . '"><a href="' . $this->replace_page($ii) . '">' . $ii . '</a></li>';
                }
            }
        }
        if ($this->page < $this->pageNum) {
            $html .= '<li class="'.$next_class.'"><a href="' . $this->replace_page($this->page + 1) . '">' . $next . '</a></li>';
        } else {
            $html .= '<li class="'.$next_class . ' ' . $disabled_class . '"><a href="javascript:void(0);">' . $next . '</a></li>';
        }
        if($hasFirstLast)
        if($this->page == 1){
            $html = '<li class="'.$first_class.' '.$disabled_class.'"><a href="'.$this->replace_page(1).'">'.$first.'</a></li>'.$html;
        }else{
            $html = '<li class="'.$first_class.'"><a href="'.$this->replace_page(1).'">'.$first.'</a></li>'.$html;
        }
        if($hasFirstLast)
        if($this->page == $this->pageNum){
            $html .= '<li class="'.$last_class.' '.$disabled_class.'"><a href="'.$this->replace_page($this->pageNum).'">'.$last.'</a></li>';
        }else{
            $html .= '<li class="'.$last_class.'"><a href="'.$this->replace_page($this->pageNum).'">'.$last.'</a></li>';
        }
        //echo $html;
        //$this->phtml .= '<li><a href="'.$this->replace_page(1).'">'.$first.'</a></li>'.$html.'<li><a href="'.$this->replace_page($this->pageNum).'">'.$last.'</a></li>';
        $this->phtml .=$html;
        $this->phtml .= '</ul>';
    }
    /**
     * 经典的CMS中常用的分页样式 
     */
    public function classic(){
        //if($this->pageNum<)
    }
    //==== 分页方法结束
    /**
     * 返回页面信息
     */
    public function output(){
        $min = ($this->page-1)*$this->listnum;
        $min = $min>0?$min:0;
        $output = array(
            'min'  => $min,
            'html' => ($this->phtml),
            'allpages' => $this->pageNum
        );
        return $output;
    }
}