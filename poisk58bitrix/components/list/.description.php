<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => "Список для инфоблоков",
	"DESCRIPTION" => "Имеет название списка, текстовое описание, фото.
									При нажатии на фото открывается фотогаллерея.",
	"ICON" => "/images/list.gif",
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "iblock",
			"NAME" => "Инфоблоки",
		),
	),
);

?>