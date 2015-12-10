<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> GouWanMei <{$title}></title>
    <{template 'Index/head'}>
    <style>
        .container .row {
            margin-top: 10%;
        }

        .tips {
            width: 400px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<php>
    function eclink($link){
    if(!empty($link))
    {
    foreach($link as $k=>$v)
    {
    echo '<a class="page-action" data-type="setTitle" title="返回" href="'.Router::url($k).'" style="font-size: 16px;">'.$v.'</a>';
    }
    }
    }
    if($type=='error')
    {
</php>
<div class="container">
    <div class="row">
        <div class="span24">
            <div class="tips tips-large tips-warning">
                <span class="x-icon x-icon-error">×</span>

                <div class="tips-content">
                    <h2><{$title}></h2>

                    <p class="auxiliary-text">
                        <{$tips}>
                    </p>

                    <p>
                        <php>eclink($link);</php>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<php>
    }else{
    $type='success';
</php>
<div class="container">
    <div class="row">
        <div class="span24">
            <div class="tips tips-large tips-<{$type}>">
                <span class="x-icon x-icon-success"><i class="icon icon-ok icon-white"></i></span>

                <div class="tips-content">
                    <h2><{$title}></h2>

                    <p class="auxiliary-text">
                        <{$tips}>
                    </p>

                    <p>
                        <{eclink($link)}>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<php>}</php>
</body>
</html>