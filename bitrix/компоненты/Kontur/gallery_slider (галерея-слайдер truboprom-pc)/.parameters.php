<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

// Тип инфоблока
$iblockTypes = [];
$result = \Bitrix\Iblock\TypeTable::getList( [
    'select' => [
        'ID',
        'NAME' => 'LANG_MESSAGE.NAME',
    ],
    'filter' => ['=LANG_MESSAGE.LANGUAGE_ID' => 'ru'],
] );
while ($row = $result->fetch()) {
    $iblockTypes[$row['ID']] = $row['NAME'];
}

// инфоблок
$iblocks = [];
$result = \Bitrix\Iblock\IblockTable::getList( [
    'select' => ['ID', 'NAME'],
    'filter' => ['IBLOCK_TYPE_ID' => $arCurrentValues['iblockType']],
] );
while ($row = $result->fetch()) {
    $iblocks[$row['ID']] = $row['NAME'];
}

// инфоблок
$elements = [];
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
$arFilter = Array("IBLOCK_ID"=>$arCurrentValues['iblockType'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $elements[] = $arFields;
}

$elements = array();
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
$arFilter = Array("IBLOCK_ID"=>$arCurrentValues["iblock"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $elements[ $arFields["ID"] ] = $arFields["NAME"];
}



// // Раздел инфоблока
// $rsSection = \Bitrix\Iblock\SectionTable::getList(array(
//     'filter' => array(
//         'IBLOCK_ID' => $arCurrentValues['iblock'],
//         'DEPTH_LEVEL' => 1,
//     ), 
//     'select' =>  array('ID','CODE','NAME'),
// ));

// $chapter = array();
// while ($arSection=$rsSection->fetch()) {
//     $chapter[ $arSection["ID"] ] = $arSection["ID"];
// }


$arComponentParameters = array(
    "GROUPS" => array(
        "BASE" => array(
            "NAME" => "основные настройки",
         ),
    ),
    "PARAMETERS" => array(
        "iblockType" => array(
            "PARENT" => "BASE",
            "NAME" => "Тип инфоблока",
            "TYPE" => "LIST",
            "ADDITIONAL_VALUES" => "Y",
            "VALUES" => $iblockTypes,
            "REFRESH" => "Y",
        ),
        "iblock" =>  array(
            "PARENT"    =>  "BASE",
            "NAME"      =>  "id инфоблока",
            "TYPE"      =>  "LIST",
            "VALUES"    =>  $iblocks,
            "REFRESH"   =>  "Y",
        ),
        // "CHAPTER_ID" => array(
        //     "NAME" => "ID раздела с фото",
        //     "TYPE" => "LIST",
        //     "PARENT" => "BASE",
        //     "ADDITIONAL_VALUES" => "Y",
        //     "VALUES" => $chapter,
        //     "REFRESH" => "Y",
        // ),
        "ELEMENT_ID" => array(
            "NAME" => "ID галереи",
            "TYPE" => "LIST",
            "PARENT" => "BASE",
            "ADDITIONAL_VALUES" => "Y",
            "VALUES" => $elements,
            "REFRESH" => "Y",
        ),
    ),
);
?>