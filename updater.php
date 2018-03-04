<?php

$folder = 'files';

if (file_exists('Files'))
{
    $folder = 'Files';
}

function listFolder($folder, $list = array())
{
    $files = glob($folder . "/*");

    foreach($files as $file)
    {
        if (is_dir($file))
        {
            $list = listFolder($file, $list);
        }
        else
        {
            $list[] = $folder . '/' . str_replace("\\", "/", substr($file, strlen($folder) + 1));
        }
    }

    return $list;
}

$files = listFolder($folder);
$result = array();

for ($i = 0; $i < sizeof($files); $i++)
{
    $file = $files[$i];
    $result[] = array(substr($file, strlen($folder) + 1), filesize($file));
}

header('Content-Type', 'application/json');
echo json_encode($result);

?>