<?php
/**
 * Created by PhpStorm.
 * Class Image
 * User: pgf
 * Date: 15-8-25
 * Time: 下午4:07
 */

class Image
{
    /**
     * 生成保持原图纵横比的缩略图，支持.png .jpg .gif
     * 缩略图类型统一为.png格式
     * $srcFile     原图像文件名称
     * $toW         缩略图宽
     * $toH         缩略图高
     * $toFile      缩略图文件名称，为空覆盖原图像文件
     * @return bool
     */
    public static function CreateThumbnail($srcFile, $toW=false, $toH=false, $toFile="")
    {
        if($toW==0 && $toH==0){
            return $srcFile;
        }
        if ($toFile == "")
        {
            $toFile = $srcFile;
        }
        $info = "";
        //返回含有4个单元的数组，0-宽，1-高，2-图像类型，3-宽高的文本描述。
        //失败返回false并产生警告。
        $data = getimagesize($srcFile, $info);
        if (!$data)
            return false;

        //将文件载入到资源变量im中
        switch ($data[2]) //1-GIF，2-JPG，3-PNG
        {
            case 1:
                if(!function_exists("imagecreatefromgif"))
                {
                    echo "the GD can't support .gif, please use .jpeg or .png! <a href='javascript:history.back();'>back</a>";
                    exit();
                }
                $im = imagecreatefromgif($srcFile);
                break;

            case 2:
                if(!function_exists("imagecreatefromjpeg"))
                {
                    echo "the GD can't support .jpeg, please use other picture! <a href='javascript:history.back();'>back</a>";
                    exit();
                }
                $im = imagecreatefromjpeg($srcFile);
                break;

            case 3:
                $im = imagecreatefrompng($srcFile);
                break;
        }

        //计算缩略图的宽高
        $srcW = imagesx($im);
        $srcH = imagesy($im);

        //$toWH = $toW / $toH;    //图片比例
        $srcWH = $srcW / $srcH; //图片真实比例
        if(!$toH || !$toW) {        //只限定宽或者高
            if (!$toH) {
                $ftoW = $toW;
                $ftoH = (int)($ftoW * ($srcH / $srcW));
            }
            if (!$toW) {
                $ftoH = $toH;
                $ftoW = (int)($ftoH * ($srcW / $srcH));
            }
        }else {                  //--强制宽高截取
            $ftoH = $toH;
            $ftoW = $toW;
            #####       计算宽高        #####
            if($srcH<=$srcW) {
                $w = $srcH/$ftoH*$ftoW;
                $srcW = $w>$srcW?$srcW:$w;
            }else{
                $h = $srcW/$ftoW*$ftoH;
                $srcH = $h>$srcH?$srcH:$h;
            }
        }
        if (function_exists("imagecreatetruecolor"))
        {
            $ni = imagecreatetruecolor($ftoW, $ftoH); //新建一个真彩色图像

            $color = imagecolorallocate($ni,255,255,255);
            imagecolortransparent($ni,$color);
            imagefill($ni,0,0,$color);
            if ($ni)
            {
                //重采样拷贝部分图像并调整大小 可保持较好的清晰度
                imagecopyresampled($ni, $im, 0, 0, 0, 0, $ftoW, $ftoH, $srcW, $srcH);
            }
            else
            {
                //拷贝部分图像并调整大小
                $ni = imagecreate($ftoW, $ftoH);
                imagecopyresized($ni, $im, 0, 0, 0, 0, $ftoW, $ftoH, $srcW, $srcH);
            }
        }
        else
        {
            $ni = imagecreate($ftoW, $ftoH);
            imagecopyresized($ni, $im, 0, 0, 0, 0, $ftoW, $ftoH, $srcW, $srcH);
        }
//        if()
        //将文件载入到资源变量im中
        switch ($data[2]) {//1-GIF，2-JPG，3-PNG
            case 1:
                imagegif($ni, $toFile);
                break;
            case 2:
                imagejpeg($ni, $toFile);
                break;
            case 3:
                imagepng($ni, $toFile);
                break;
            default:
                imagepng($ni, $toFile); //以 PNG 格式将图像输出到浏览器或文件
        }
        ImageDestroy($ni);
        ImageDestroy($im);
        return true;
    }
}