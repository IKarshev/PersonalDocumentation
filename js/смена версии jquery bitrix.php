<?
/*
* 1. Вставить в php init
* 2. Прописать путь до нужной версии jquery
* 3. Перезагрузить страницу
* 4. Проверить что версия сменилась прописав в консоли браузер — jQuery.fn.jquery
*/
AddEventHandler("main", "OnPageStart", "registerJqueryHandler");
function registerJqueryHandler() 
{
      //Hack: when init first extension - bitrix register standart extensions
      $emptyHack = [
         'css' => "",
         'skip_core' => true,
      ];
      \CJSCore::RegisterExt('emptyHack', $emptyHack);
      \CJSCore::Init('emptyHack');
 
	$arJSLib = array(
  	   'js' => '/bitrix/js/main/jquery/jquery-1.12.4.min.js', 
	   'skip_core' => true
	);
	\CJSCore::RegisterExt('jquery', $arJSLib);
}
?>