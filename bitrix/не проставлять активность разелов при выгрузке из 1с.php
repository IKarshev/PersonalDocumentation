<?
// прописать в init.php
AddEventHandler("iblock", "OnBeforeIBlockSectionUpdate","DoNotUpdateSect");
function DoNotUpdateSect(&$arFields){
   if ($_REQUEST['mode']=='import'){
    unset($arFields['ACTIVE']);
    };
};?>