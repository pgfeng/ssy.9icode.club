function pics(selecter){
    var input=$(selecter).clone();
    var ul=$(selecter).parent().parent().find('ul.piclist');
    input.removeAttr('id');
    input.attr('value',input.val());
    input.attr('class','pics');
    var li='<li>'+input[0].outerHTML+' <a class="button bui-form-field" href="javascript:;" onclick="viewPic(this)">预览</a> <a class="button bui-form-field" href="javascript:;" onclick="delPic(this)">删除</a></li>';
    ul.append(li);
    ul.height(ul.height()+30);
    $(selecter)[0].value='';
}
function viewPic(selecter){
    window.open($(selecter).parent().find('.pics').val(),"newwindow", "height=400, width=400, toolbar=no, menubar=no, scrollbars=no, location=no, status=no");
}
function delPic(selecter){
    var ul = $(selecter).parent().parent().parent().find('.piclist');
    $(selecter).parent().remove();
    ul.height(ul.height()-30);
}