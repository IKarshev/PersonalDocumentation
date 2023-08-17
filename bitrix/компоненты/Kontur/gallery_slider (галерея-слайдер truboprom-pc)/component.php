<? require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$arResult = array();
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PUCTURES" );
$arFilter = Array("IBLOCK_ID"=>$arParams["iblock"], "ID" => $arParams["ELEMENT_ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();

    $rsFile = CFile::GetByID( $arFields["PROPERTY_PUCTURES_VALUE"] );
    $arFile = $rsFile->Fetch();

    $arFields["PICTURE"] = $arFile;
    $arResult[] = $arFields;
};

$this->IncludeComponentTemplate();
?>