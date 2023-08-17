<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");?>

<?CJSCore::Init(array("jquery"));?>

<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/slick.css", true);?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/slick.min.js");?>

<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/lightbox.css", true);?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/lightbox.js");?>


<?//echo $arParams["ELEMENT_ID"];?>

<!-- <pre><?print_r($arResult);?></pre> -->

<div class="gallery">
    <div class="slider_header">
        <div class="gallery_title">Фотогалерея</div>    
        <div class="countsSlides">
            <span class="current">1</span>
            /
            <span class="max"></span>
        </div>
    </div>

    <div class="gallery_container">
        <div class="arrow prev"><img src="<?=SITE_TEMPLATE_PATH?>/images/left_arrow.svg" alt=""></div>
        <div class="gallery_slider" >
            <?foreach($arResult as $arKey=>$arItem):?>

                <?
                if ( $arKey == 0 ){
                    $app = new CBitrixComponent();
                    //пишем внутри цикла при выводе элемента инфоблока
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
                };
                ?>

                <div <?if ($arKey == 0):?> id="<?=$app->GetEditAreaID($arItem['ID'])?>" <?endif;?> class="img_block">
                    <a data-lightbox="Image_<?=$arKey;?>" href="<?=$arItem["PICTURE"]["SRC"];?>">
                        <img src="<?=$arItem["PICTURE"]["SRC"];?>" alt="">
                    </a>
                </div>
            <?endforeach;?>


        </div>
        <div class="arrow next"><img src="<?=SITE_TEMPLATE_PATH?>/images/left_arrow.svg" alt=""></div>
    </div>
</div>