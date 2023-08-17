<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
/**
 * Источник — https://nikaverro.ru/blog/bitrix/rabota-s-seo-sayta-cherez-api/
 * 
 * файл: component_epilog.php
 * Добавляем в компонент catalog чтобы при пагинации $PAGEN_2=2 в meta title подставлялся
 * порядковый номер страницы.
 * — В некоторых случаях в component_epilog.php не работает и нужно вставить в section или другой файл
 * в зависимости от архитектуры.
 * 
 * Для разделов:
 * new \Bitrix\Iblock\InheritedProperty\SectionValues($arParams['IBLOCK_ID'], $arParams['SECTION_ID']);
 * 
 * Для элементов:
 * new \Bitrix\Iblock\InheritedProperty\ElementValues($iblockId,$elementId);
 * 
 * Для инфоблоков:
 * new \Bitrix\Iblock\InheritedProperty\IblockValues($iblockId);
 * 
 * Правило редиректа с /?PAGEN_1=1 на / :
 * <IfModule mod_rewrite.c>
 *   RewriteCond %{QUERY_STRING} (?:^|&)PAGEN_1\=1(?:$|&)
 *   RewriteRule ^(.*)$ /$1? [R=301,L]
 * </IfModule>
 * 
 */
global $APPLICATION; 

// seo
$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arParams['IBLOCK_ID'], $arParams['SECTION_ID']);
$IPROPERTY  = $ipropValues->getValues();
if ( isset($_GET["PAGEN_2"]) && $_GET["PAGEN_2"] > 1 ){
	$new_title = $IPROPERTY["SECTION_META_TITLE"]." стр.".$_GET["PAGEN_2"];
	$APPLICATION->SetPageProperty("title", $new_title);
};