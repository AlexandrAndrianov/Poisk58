<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => "Тип информационного блока",
			"TYPE" => "STRING",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => "ID информационного блока",
			"TYPE" => "STRING",
		),
		"ELEMENT_ID" => array(
			"PARENT" => "BASE",
			"NAME" => "ID элемента инфоблока",
			"TYPE" => "STRING",
			"DEFAULT" => '={$_REQUEST["ELEMENT_ID"]}',
		),
		
	),
);
?>