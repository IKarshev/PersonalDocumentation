<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
session_start();
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

    public function generate_form_id($form_prefix) {
        $this->form_postfix = $this->randomString();
        $this->form_id = $form_prefix."_".$this->form_postfix;
        
        return $this->form_id;
    }

    public function validate_string($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
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
            // Генерируем название формы
            $this->form_id = $this->generate_form_id("Order_call");
            // формируем arResult
            $this->getResult($this->form_id);
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

    protected function getResult($form_id){ // подготовка массива $arResult (метод подключается внутри класса try...catch)
        // Формируем массив arResult
        $this->arResult["form_id"] = $this->form_id;
        // Передаем параметры в сессию, чтобы получить иметь доступ в ajax
        $_SESSION['arParams'] = $this->arParams;
  
        return $this->arResult;
    }

    public function Send_FormAction(){
        $request = Application::getInstance()->getContext()->getRequest();
        // получаем файлы, post
        $post = $request->getPostList();
        $files = $request->getFileList()->toArray();
        // Получаем параметры компонента из сессии
        $this->arParams = $_SESSION['arParams'];

        // Валидация текстовых полей
        foreach ($post as $key => $value) {
            if( $value != "" ){// Проверяем пустые массивы
                if( gettype($value) == "array" ){
                    foreach ($value as $key2 => $value2) {
                        $arResult[$key][] = $this->validate_string( $value2 );
                    };
                } else{// Валидация ключей массивов (списки)
                    $arResult[$key] = $this->validate_string( $value );
                };
            };
        };


        // Добавление в инфоблок
        $el = new CIBlockElement;
        $PROP["TELEPHONE_NUMBER"] = $arResult["phone"];
        $arLoadProductArray = Array(
            "MODIFIED_BY" => "1",
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID" => $this->arParams["IBLOCK"],
            "PROPERTY_VALUES"=> $PROP,
            "NAME" => "Заявка от ".date('d.m.Y'),
            "ACTIVE" => "Y",
        );
        $PRODUCT_ID = $el->Add($arLoadProductArray);

        // Почтовое событие
        $PROP["DATE"] = date('d.m.Y H:i');
        CEvent::Send("ORDER_CALL", $arResult["SITE_ID"], $PROP);

    } 

}