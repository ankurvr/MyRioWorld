<?php

    if (empty($_POST) === false)
    {
        require './lib/CreateZip.php';

        $Action = $_POST['action'];
        $Albums = $_POST['albums'];

        switch($Action)
        {
            case 'startDownload':
            {
                $MainPath = './Downloads/'.time();

                foreach($Albums as $album)
                {
                    $Alb_id = $album[0];    unset($album[0]);
                    $Alb_name = preg_replace("/[^a-zA-Z0-9]/", "_", $album[1]);  unset($album[1]);
                    array_values($album);

                    $Path = $MainPath.'/'.$Alb_name;
                    mkdir($Path, 0777, true);

                    foreach($album as $image)
                    {
                        //image_save_from_url($image, $File_Path);
                        if($Path!="" && $Path){
                            $File_Path = $Path."/".basename($image);
                        }
                        $ch = curl_init ($image);
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
                        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
                        $rawdata=curl_exec($ch);
                        curl_close ($ch);
                        if(file_exists($File_Path)){
                            unlink($File_Path);
                        }
                        $fp = fopen($File_Path,'x');
                        fwrite($fp, $rawdata);
                        fclose($fp);
                    }
                }
                $zip_file_name = './Downloads/Zips/Albums_'.time().'.zip';
                $the_folder = $MainPath;

                $za = new FlxZipArchive;

                $res = $za->open($zip_file_name, ZipArchive::CREATE);

                if($res === TRUE) {
                    $za->addDir($the_folder, basename($the_folder));
                    $za->close();

                    echo json_encode(array('result' => 'success', 'msg' => basename($zip_file_name)));
                }
                else
                    echo json_encode(array('result' => 'error', 'msg' => 'Could not create a zip archive'));
                exit();
            }
            break;
        }
    }

    if(empty($_GET) === false)
    {
        $file_name = './Downloads/Zips/'.$_GET['albums'];

        // make sure it's a file before doing anything!
        if(is_file($file_name))
        {
            // required for IE
            if(ini_get('zlib.output_compression'))
            {
                ini_set('zlib.output_compression', 'Off');
            }

            header('Pragma: public'); // required
            header('Expires: 0'); // no cache
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Cache-Control: private',false);
            header('Content-Type: sapplication/zip');
            header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: '.filesize($file_name)); // provide file size
            readfile($file_name); // push it out
            exit();
        }
    }
?>