<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="/admin/public/css/bs3/dpl-min.css" type="text/css" rel="stylesheet"><link href="/admin/public/css/bs3/bui-min.css" type="text/css" rel="stylesheet"><link href="/admin/public/css/gouwanmei.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/admin/public/js/jquery-1.8.1.min.js"></script><script type="text/javascript" src="/admin/public/js/bui-min.js"></script><script type="text/javascript" src="/admin/public/js/config.js"></script>
<script>
    $(document).ready(function () {
        var select = $('select');
        for (var i=0;i<select.size();i++){
            if($(select[i]).attr('val')!=''){
                $(select[i]).find('option[value="'+$(select[i]).attr('val')+'"]').attr('selected','true');
            }
        }
    });
</script>