<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");?>
<?
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Entity;
use Bitrix\Main\Application;

	
class IkeaPropTable extends Entity\DataManager{
	public static function getTableName()
	{
		return 'Autoresponse_log';
	}
	public static function getMap()
	{
		return array(
			new Entity\IntegerField('ID', array('primary'=>true,'autocomplete'=>true)),
			new Entity\StringField('EMAIL'),
			new Entity\StringField('SUBJECT_APPEAL'),	
		);
	}
}

$connection = Application::getInstance()->getConnection();
            if(!$connection->isTableExists(IkeaPropTable::getTableName()))
                IkeaPropTable::getEntity()->createDbTable();


// ---------------------------------------

	$aRow =  IkeaPropTable::getList([
	'select' => 
	[
		'EMAIL',
		'SUBJECT_APPEAL',
	],
	'filter' => ['=ID'=>1],
	])->fetchAll();
	

// ---------------------------------------	

	IkeaPropTable::add([
		'EMAIL'=>'String',
		'SUBJECT_APPEAL'=>'String',
	]);
	
// ---------------------------------------
	
	// IkeaPropTable::update($ID,['STRING_FIELD'=>'String-update']);
?>
