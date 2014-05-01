<?php
    $my_img[]='http://images.askmen.com/galleries/cobie-smulders/picture-1-134686094208.jpg';
    $my_img[]='http://images.askmen.com/galleries/demi-lovato/picture-1-134212249378.jpg';
    $fullpath = "images_saved";
    foreach($my_img as $i){
        image_save_from_url($i,$fullpath);
        if(getimagesize($fullpath."/".basename($i))){
            echo '<h3 style="color: green;">Image ' . basename($i) . ' Downloaded Successfully</h3>';
        }else{
            echo '<h3 style="color: red;">Image ' . basename($i) . ' Download Failed</h3>';
        }
    }
    function image_save_from_url($my_img,$fullpath){
        if($fullpath!="" && $fullpath){
            $fullpath = $fullpath."/".basename($my_img);
        }
        $ch = curl_init ($my_img);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
        $rawdata=curl_exec($ch);
        curl_close ($ch);
        if(file_exists($fullpath)){
            unlink($fullpath);
        }
        $fp = fopen($fullpath,'x');
        fwrite($fp, $rawdata);
        fclose($fp);
    }
?>


