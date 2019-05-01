<?php

spl_autoload_register(function($class){
    $BaseDIR='../Gallery';
    $listDir=scandir(realpath($BaseDIR));
    
    if (isset($listDir) && !empty($listDir))
    {
        foreach ($listDir as $listDirkey => $subDir)
        {
            
            $file = $BaseDIR.DIRECTORY_SEPARATOR.$subDir.DIRECTORY_SEPARATOR.$class.'.php';
     
            if (file_exists($file))
            {
     
                require $file;
            }
        }
    }});