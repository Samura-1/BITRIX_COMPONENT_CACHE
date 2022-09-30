<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_LIST"),
	"DESCRIPTION" => GetMessage("T_IBLOCK_DESC_LIST_DESC"),
	"ICON" => "/images/news_list.gif",
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "mycomponent",
			"NAME" => GetMessage("T_IBLOCK_DESC_CAT"),
			"SORT" => 10,
		),
	),
);

?>