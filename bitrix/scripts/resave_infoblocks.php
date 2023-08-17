<?
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");?>

<?
if(CModule::IncludeModule('iblock')){
    $el = new CIBlockElement;
    $Filter = array("IBLOCK_ID" => 82, "ACTIVE" => "Y", "SECTION_ID"=>);
    $res = CIBlockElement::GetList(array("NAME"=>"ASC"), $Filter, false, false, array('ID', 'IBLOCK_ID', 'NAME'));
    while($ob = $res->GetNext()){
        $res1 = $el->Update($ob["ID"], array('NAME' => $ob['NAME']));
    }
}
?>