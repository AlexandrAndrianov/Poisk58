<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?> 
<?
	define("TITLE", "MENU_LIST_TITLE_"); 
	define("ELEM", "MENU_LIST_");
?>

<?
	$arResult = Array();
	for($i=1; true; $i++)
	{
		$db_title = CIBlockProperty::GetList(Array(), Array("CODE"=>TITLE.$i));
		$db_title->NavStart();
		if(!$db_title->NavRecordCount)
		{
			break;
		}
		
		while($arTitle = $db_title->GetNext())
		{
			for($y=1; true; $y++)
			{
				$db_name = CIBlockProperty::GetList(Array(), Array("CODE"=>ELEM.$i.'_'.$y));
				$arElNam = $db_name->Fetch();
				
				$db_el = CIBlockProperty::GetPropertyEnum(ELEM.$i.'_'.$y, Array(), Array());
				$db_el->NavStart();
				if(!$db_el->NavRecordCount)
				{
					break;
				}
	
				while($arElem = $db_el->GetNext())
				{
					$arResult[$i][$arTitle['NAME']][$arElNam['NAME']][$arElem['XML_ID']] = $arElem['VALUE'];
				}
			}	
		}
		
	}
?>

<?$this->IncludeComponentTemplate()?>