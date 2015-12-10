<?php

/********************************************************
 *            CURL操作类                                    *
 ********************************************************
 *        Author: 高峰 (admin@9icode.net)                    *
 ********************************************************
 *        UpdateTime: 2014-04-02                            *
 *******************************************************/
class curl
{
    public $result = array();
    private $ch;            //存放curl获取的信息

    public function __construct($url)
    {
        if ($url)
            $this->init($url);
    }

    public function init($url)
    {
        $this->ch = curl_init($url);    //初始化CURL
        //************设置不自动输出页面内容**********
        $this->setopt(CURLOPT_RETURNTRANSFER, true);
    }

    //执行并返回信息

    function setopt($option, $value)
    {
        curl_setopt($this->ch, $option, $value);
    }

    function exec()
    {
        $this->result['response'] = curl_exec($this->ch);
        if (curl_getinfo($this->ch, CURLINFO_HTTP_CODE) == '200') {
            $this->result['headerSize'] = curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);
            $this->result['header'] = substr($this->result['response'], 0, $this->result['headerSize']);
            $this->result['body'] = substr($this->result['response'], $this->result['headerSize']);
            $this->parse_header();
        }
        return $this->result['response'];
    }

    // 打开SSL

    function parse_header()
    {
        $a = explode(';', $this->result['header']);
        $this->result['COOKIE'] = array();
        //解析cookie内容
        preg_match_all('/set\-cookie:([^\r\n]*)/i', $this->result['header'], $cookie);
        preg_match_all('/set\-cookie:(.*);/iUs', $this->result['header'], $c);
        foreach ($c[1] as $a) {
            $co = explode('=', $a);
            //print_r($co);
            $this->result['cookie'][2][trim($co[0])] = trim($co[1]);
        }
        $this->result['cookie'][0] = $cookie;
        $this->result['cookie'][1] = $c;
        //print_r($this->result['cookie'][2]);
    }

    function referer($referer)
    {
        $this->setopt(CURLOPT_REFERER, $referer);
    }

    function opssl()
    {
        $this->setopt(CURLOPT_SSL_VERIFYPEER, FALSE);
        $this->setopt(CURLOPT_SSL_VERIFYHOST, FALSE);
    }

    //设置header和是否显示header内容

    function __destruct()
    {
        if ($this->ch)
            curl_close($this->ch);
    }
    //**********POST数据
    //====需要下标
    /*--array(
    *		'a'=>'a',
    *		'b'=>'b'
    *	);
    */

    function post($data)
    {
        $this->setopt(CURLOPT_POST, 1);
        if (is_array($data))
            $this->setopt(CURLOPT_POSTFIELDS, http_build_query($data));
        else
            $this->setopt(CURLOPT_POSTFIELDS, $data);
    }

    //是否需要BODY内容
    function body($true = 1)
    {
        if ($true)
            $this->setopt(CURLOPT_NOBODY, 0);
        else
            $this->setopt(CURLOPT_NOBODY, 1);
    }

    //设置UA
    function ua($value)
    {
        $this->setopt(CURLOPT_USERAGENT, $value);
    }
	function ip($ip){
		$header = array( 
			'CLIENT-IP:'.$ip, 
			'X-FORWARDED-FOR:'.$ip, 
			); 
			$this->header($header);
	}
    /*******
     *    不使用CURL自带COOKIE处理机制
     *    直接向HEADER头文件中添加COOKIE
     *    数组格式：带不带下标皆可
     ******/
    function cookie($cookie)
    {
        if (is_array($cookie)) {
            $comCookie = array();
            $cc = 'COOKIE:';
            if (empty($cookie[0])) {

                foreach (array_keys($cookie) as $k) {
                    $cc .= trim($k) . '=' . trim($cookie[$k]) . ';';
                }
            } else {
                foreach ($cookie as $c) {
                    if (!empty($c))
                        $cc .= trim($c) . ";";
                }
            }
            $comCookie[] = $cc;
        } else {
            $comCookie = array(
                'COOKIE:' . trim($cookie)
            );
        }
        $this->header($comCookie);
    }

    function header($header = false)
    {
        if ($header == false) {
            $this->setopt(CURLOPT_HEADER, 1);
            $this->setopt(CURLOPT_RETURNTRANSFER, true);
            $this->setopt(CURLOPT_AUTOREFERER, true);
            $this->setopt(CURLOPT_TIMEOUT, 30);
        } else {
            //print_r($header);
            $this->setopt(CURLOPT_HTTPHEADER, $header);
        }
    }

    function fllowlocation()
    {
        $this->setopt(CURLOPT_FAILONERROR, 1);
    }

    //第一个参数是文件位置，第二个是文件上传域名称,第三个是POST内容

    function upload($filepath, $fileFiled, $post = false)
    {
        $data = array($fileFiled => '@' . $filepath);
        if ($post)
            $data = array_merge($data, http_build_query($post));
        $this->setopt(CURLOPT_POST, 1);
        $this->setopt(CURLOPT_POSTFIELDS, $data);
    }
}
