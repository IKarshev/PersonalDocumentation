<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Main\Loader;
use Bitrix\Main\Type\Date;

use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Engine\ActionFilter;

use \Bitrix\Main\Application;
use \Bitrix\Iblock\SectionTable;
use \Bitrix\Iblock\ElementTable;
use \Bitrix\Iblock\PropertyTable;
session_start();

Loader::includeModule('iblock');

class FormComponent extends CBitrixComponent implements Controllerable{

    public function randomString($length = 8) { 
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $charactersLength = strlen($characters); 
        $randomString = ''; 
        for ($i = 0; $i < $length; $i++) { 
            $randomString .= $characters[rand(0, $charactersLength - 1)]; 
        } 
        return $randomString; 
    }

    public function is_in_array($elem, $array){// Метод для проверки вхождения значения в массив
        foreach ($array as $key => $value) {
            if ( $value == $elem ){
                return true;
            };
        };
        return false;
    }

    public function configureActions(){
        // сбрасываем фильтры по-умолчанию
        return [
            'Send_Form' => [
                'prefilters' => [],
                'postfilters' => []
            ]
        ];
    }

    public function executeComponent(){// подключение модулей (метод подключается автоматически)
        try{
            // Проверка подключения модулей
            $this->checkModules();
            // формируем arResult
            $this->getResult();
            // подключение шаблона компонента
            $this->includeComponentTemplate();
        }
        catch (SystemException $e){
            ShowError($e->getMessage());
        }
    }

    protected function checkModules(){// если модуль не подключен выводим сообщение в catch (метод подключается внутри класса try...catch)
        if (!Loader::includeModule('iblock')){
            throw new SystemException(Loc::getMessage('IBLOCK_MODULE_NOT_INSTALLED'));
        }
    }


    public function onPrepareComponentParams($arParams){//обработка $arParams (метод подключается автоматически)
        return $arParams;
    }

    protected function getResult(){ // подготовка массива $arResult (метод подключается внутри класса try...catch)
        // Формируем массив arResult
        
        $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_TEXT");
        $arFilter = Array("IBLOCK_ID"=>$this->arParams["IBLOCK_ID"], "ID"=>$this->arParams["ELEMENT_ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        while($ob = $res->GetNextElement()){
            $arFields = $ob->GetFields();
            $this->arResult["ITEMS"][] = array(
                "ID" => $arFields["ID"],
                "POPUP_ID" => "site-popup_".$arFields["ID"],
                "TITLE" => $arFields["NAME"],
                "DETAIL" => $arFields["PREVIEW_TEXT"],
            );
        }
        return $this->arResult;
    }
}