<?php

class Page
{
    public $url;                            //url地址	如：index.html?page=标记
    public $total;                            //总记录数
    public $listnum;                        //页面记录数
    public $page;                            //当前page值
    public $pageNum;                        //总页面数
    public $config = array(                    //默认设置，可以设置
        'active' => '.active',        //当前页的样式，在按钮上使用
        'listyle' => '',                //默认样式
        'ulstyle' => '.pagination .pagination-lg',    //ul列表样式
        'disabled' => '.disabled',    //禁用时的样式 ，在上页和下页上使用
        'btn_nums' => 5,                //默认显示最多的按钮数量
        'prev' => '&laquo;',
        'next' => '&raquo;',
        'mark' => '%page%',        //替换成页码数的标记
    );
    private $phtml='';

    /**
     * 分页构造方法
     * @param Int $total 总记录数
     * @param String $url 网址，需要包含标记，参考$this->config['mark']
     * @param Int $page 当前分页值
     * @param int $listnum 每页显示的记录数
     */
    public function init($total, $url = '', $page = '', $listnum = 10)
    {
        //echo $page;exit;
        $this->url = $url;
        $this->page = $page >= 1 ? intval($page) : 1;
        $this->total = $total;
        $this->listnum = $listnum;
        $pageNum = ceil($total / $listnum);
        $this->pageNum = $pageNum >= 1 ? intval($pageNum) : 1;
    }

    //======== 	输入结果
    //========  返回LIMIT的最小值，分页的HTML内容以及当前page值
    public function p()
    {
        $p = $this->pageNum > $this->config['btn_nums'] ? $this->config['btn_nums'] : $this->pageNum;
        $this->phtml = '<ul' . $this->attr_style($this->config['ulstyle']) . '>';
        if ($this->page > 1) {
            $this->phtml .= '<li><a href="' . $this->replace_page($this->page - 1) . '">' . $this->config['prev'] . '</a></li>';
        } else {
            $this->phtml .= '<li' . $this->attr_style($this->config['disabled']) . '><a href="javascript:void(0);">' . $this->config['prev'] . '</a></li>';
        }

        $btn_nums_2 = floor($this->config['btn_nums'] / 2);
        if (($this->page - $btn_nums_2) >= 1 && ($this->pageNum - $btn_nums_2) >= $this->page) {
            for ($i = 0; $i < $p; $i++) {
                $ii = ($this->page - $btn_nums_2) + $i;
                $attr = $ii == $this->page ? $this->attr_style($this->config['active']) : '';
                $this->phtml .= '<li' . $attr . '><a href="' . $this->replace_page($ii) . '">' . $ii . '</a></li>';
            }

        } else {
            if ($this->page < $this->config['btn_nums']) {
                for ($i = 0; $i < $p; $i++) {
                    $ii = $i + 1;
                    $attr = $ii == $this->page ? $this->attr_style($this->config['active']) : '';
                    $this->phtml .= '<li' . $attr . '><a href="' . $this->replace_page($ii) . '">' . $ii . '</a></li>';
                }
            } else {
                for ($i = 0; $i < $p; $i++) {
                    $ii = ($this->pageNum - ($this->config['btn_nums'] - 1)) + $i;
                    $attr = $ii == $this->page ? $this->attr_style($this->config['active']) : '';
                    $this->phtml .= '<li' . $attr . '><a href="' . $this->replace_page($ii) . '">' . $ii . '</a></li>';
                }
            }
        }
        if ($this->page < $this->pageNum) {
            $this->phtml .= '<li><a href="' . $this->replace_page($this->page + 1) . '">' . $this->config['next'] . '</a></li>';
        } else {
            $html['next'] = array(
                'html' => $this->config['next'],
                'href' => 'javascript:void(0);',
                'class' => $this->config['disabled']
            );
            $this->phtml .= '<li' . $this->attr_style($this->config['disabled']) . '><a href="javascript:void(0);">' . $this->config['next'] . '</a></li>';
        }
        $this->phtml .= '</ul>';
        //return $this->phtml ;
        $page = array(
            'html' => $this->phtml,
            'page' => $this->page,
            'pageNum' => $this->pageNum,
            'min' => ($this->page - 1) * $this->listnum
        );
        return $page;
    }

    //--------	替换样式

    private function attr_style($style)
    {
        $style = explode(' ', $style);
        $attr = '';
        $id = '%id%';
        $class = '%class%';
        foreach ($style as $value) {
            switch ($value[0]) {
                case '.':
                    $class = str_replace('%class%', ' ' . substr($value, 1) . '%class% ', $class);
                    break;
                case '#':
                    $id = str_replace('%id%', ' ' . substr($value, 1) . '%id% ', $id);
                    break;
                default:
                    return false;
                    break;
            }
        }
        $id = trim(str_replace('%id%', '', $id));
        $class = trim(str_replace('%class%', '', $class));
        $id = !empty($id) ? ' id="' . $id . '"' : '';
        $class = !empty($class) ? ' class="' . $class . '"' : '';
        return $id . $class;
    }

    //====替换标记
    private function replace_page($num)
    {
        return str_replace($this->config['mark'], $num, $this->url);
    }
}