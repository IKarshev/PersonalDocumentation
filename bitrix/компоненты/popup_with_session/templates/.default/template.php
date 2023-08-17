<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");?>
<?$session_id = $arParams["SESSION_ID"];?>

<?foreach ($arResult["ITEMS"] as $arkey => $arItem):?>
    <?if ( $arParams["ONE_TIME_IN_SESSION"] == "N" || ( $arParams["ONE_TIME_IN_SESSION"] == "Y" && !isset($_SESSION["POPUP_".$arParams["SESSION_ID"]]) ) ):?>
    
        <div id="site-popup_<?=$arItem["ID"];?>" class="site-info-popup" style="display: none;">
            <div class="site-info-title">
                <?=$arItem['NAME'];?>
            </div>
            
            <div class="site-info-content">
                <?=$arItem['DETAIL'] ?>	
            </div>
            
            <div class="site-info-actions">
                <button type="button" id="site_popup_close_<?=$arItem["ID"]?>">Ок</button>
            </div>
        </div>

        <script>
            if ( $('#<?=$arItem["POPUP_ID"];?>').length > 0 ) {
                setTimeout(function() {
                    $.fancybox({
                        href: '#site-popup_<?=$arItem["ID"];?>', 
                        modal: true
                    });
                }, 500);
                
                $('#site_popup_close_<?=$arItem["ID"]?>').click(function() {
                    console.log("test1");
                    $.fancybox.close();
                });		
            };
        </script>
    <?endif;?>
<?endforeach;?>

<?
if ( $arParams["ONE_TIME_IN_SESSION"] = "Y" ){
    $_SESSION["POPUP_".$arParams["SESSION_ID"]] = "Y";
};?>