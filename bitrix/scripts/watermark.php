<?
$aWaterPhoto = [[
            "name" => "watermark",
        "position" => "center", // Положение
            "type" => "image",
            "file" => $_SERVER['DOCUMENT_ROOT'].'/local/img/water-300-40.png',
            "fill" => "repeat",
    ]];            

$aResizeFull = CFile::ResizeImageGet(
    $photoId,
    $aOption['photo'],
    BX_RESIZE_IMAGE_PROPORTIONAL,
    true,
    $aWaterPhoto
);