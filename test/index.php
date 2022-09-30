<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><?$APPLICATION->IncludeComponent(
	"listitems", 
	"inner_items_template", 
	array(
		"COMPONENT_TEMPLATE" => "inner_items_template",
		"IBLOCK_TYPE" => "Items",
		"IBLOCK_ID" => "5",
		"NEWS_COUNT" => "3",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"COUNT" => "3"
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>