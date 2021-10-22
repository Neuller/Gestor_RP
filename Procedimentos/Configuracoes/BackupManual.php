<?php 
    $dir_path = "../../../../mysql/data/";
    $dir_destino = "../../../../../Backup Gestor RP";
    $dir_copy = opendir($dir_path) ;

    if(!is_dir($dir_destino))
    mkdir($dir_destino,0777);

    while($file=readdir($dir_copy))
    {
    if(substr($file,0,1) != ".")
    {
    copy($dir_path."/".$file,$dir_destino."/".$file);
    }
    }

    $dir_base_app = "../../../../mysql/data/gestor_rp";
    $dir_destino_app = "../../../../../Backup Gestor RP/gestor_rp";
    $dir_copy_app = opendir($dir_base_app) ;

    if(!is_dir($dir_destino_app))
    mkdir($dir_destino_app,0777);

    while($file=readdir($dir_copy_app))
    {
    if(substr($file,0,1) != ".")
    {
    copy($dir_base_app."/".$file,$dir_destino_app."/".$file);
    }
    }
?>