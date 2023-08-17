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
$iblocks = array();
$result = \Bitrix\Iblock\IblockTable::getList( [
    'select' => ['ID', 'NAME'],
    'filter' => ['IBLOCK_TYPE_ID' => $arCurrentValues['IBLOCKTYPE']],
] );
while ($row = $result->fetch()) {
    $iblocks[$row['ID']] = $row['NAME'];
}

$elements = array();
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
$arFilter = Array("IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $elements[ $arFields["ID"] ] = $arFields["NAME"];
}


$arComponentParameters = array(
    "GROUPS" => array(
        "BASE" => array(
            "NAME" => "основные настройки",
        ),
        "SESSION_SETTINGS" => array(
            "NAME" => "Настройки сессии",
        ),
    ),
    "PARAMETERS" => array(
        "IBLOCKTYPE" => array(
            "PARENT" => "BASE",
            "NAME" => "Тип инфоблока",
            "TYPE" => "LIST",
            "ADDITIONAL_VALUES" => "N",
            "VALUES" => $iblockTypes,
            "REFRESH" => "Y",
        ),
        "IBLOCK_ID" =>  array(
            "PARENT"    =>  "BASE",
            "NAME"      =>  "id инфоблока",
            "TYPE"      =>  "LIST",
            "VALUES"    =>  $iblocks,
            "REFRESH"   =>  "Y",
        ),
        "ELEMENT_ID" => array(
            "NAME" => "Поп-ап",
            "TYPE" => "LIST",
            "PARENT" => "BASE",
            "ADDITIONAL_VALUES" => "N",
            "VALUES" => $elements,
            "REFRESH" => "Y",
        ),
        "ONE_TIME_IN_SESSION" => array(
            "NAME" => "Отображать один раз за сессию?",
            "TYPE" => "LIST",
            "DEFAULT" => "N",
            "PARENT" => "SESSION_SETTINGS",
            "ADDITIONAL_VALUES" => "N",
            "VALUES" => array("Y" => "да", "N" => "нет"),
            "REFRESH" => "Y",
        ),
    ),
);

if ( $arCurrentValues["ONE_TIME_IN_SESSION"] == "Y" ){
    $arComponentParameters["PARAMETERS"]["SESSION_ID"] = array(
        "NAME" => "ID сессии",
        "PARENT" => "SESSION_SETTINGS",
        "TYPE" => "STRING",
    );
}

?>