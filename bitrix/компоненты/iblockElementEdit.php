<?/*
    Скрипт для вывода возможности редактировать элемент инфоблока в компоненте в визуальном редакторе
*/?>


<?$app = new CBitrixComponent();?><!-- пишем вначале файла -->

<?//пишем внутри цикла при выводе элемента инфоблока
$arButtons = CIBlock::GetPanelButtons(
    $arItem["IBLOCK_ID"],
    $arItem["ID"],
    0,
    array("SECTION_BUTTONS"=>false, "SESSID"=>false)
);
$arItem["ADD_LINK"] = $arButtons["edit"]["add_element"]["ACTION_URL"];
$arItem["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
$arItem["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"]; 
$arItem["ADD_LINK_TEXT"] = $arButtons["edit"]["add_element"]["TEXT"];
$arItem["EDIT_LINK_TEXT"] = $arButtons["edit"]["edit_element"]["TEXT"];
$arItem["DELETE_LINK_TEXT"] = $arButtons["edit"]["delete_element"]["TEXT"];
$app->AddEditAction($arItem['ID'], $arItem['ADD_LINK'], $arItem["ADD_LINK_TEXT"]);
$app->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $arItem["EDIT_LINK_TEXT"]);
$app->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $arItem["DELETE_LINK_TEXT"], array("CONFIRM" => 'Точно удалить?'));
?>

<div id="<?=$app->GetEditAreaID($arItem['ID'])?>"></div><!-- выводим элемент для редактирования внутри цикла -->