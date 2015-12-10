{template "Content/head"}
<div class="wrap">
    <div style="height: 300px;background: #fff;margin-top:20px;line-height: 300px;">
        <h1 style="text-align: center;">{$message.content}</h1>
    </div>
</div>
{if $locationhref}
<script>
    setTimeout("javascript:location.href='{$locationhref}'", 5000);
</script>
{/if}
{template "Content/foot"}