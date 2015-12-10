/**
 * Created by PGF on 2015/10/6.
 */
(function($) {
    $.fn.areaSelect = function(level,style,value) {
        //alert(level);
        //alert($(this).attr('id'));
        if(level=='1'){
            $(this).append("<select class='"+style+" procince' name='"+$(this).attr('name')+"'><option value='0'>省份</option></select>");
        }
        if(level=='2'){
            $(this).append("<select class='"+style+" procince' name='"+$(this).attr('name')+"'><option value='0'>省份</option></select>");
            $(this).append("&nbsp;&nbsp;<select class='"+style+" city' name='"+$(this).attr('name')+"'><option value='0'>城市</option></select>");
        }if(level=='3'){
            $(this).append("<select class='"+style+" procince' name='"+$(this).attr('name')+"'><option value='0'>省份</option></select>");
            $(this).append("&nbsp;&nbsp;<select class='"+style+" city' name='"+$(this).attr('name')+"'><option value='0'>城市</option></select>");
            $(this).append("&nbsp;&nbsp;<select class='"+style+" district' name='"+$(this).attr('name')+"'><option value='0'>县区</option></select>");
        }

    };
})(jQuery);