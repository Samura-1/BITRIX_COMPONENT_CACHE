<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Рога и Сила");
?><br>
 <section class="pb-4 px-6">
<div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-6">
	<div class="bg-white w-full border border-gray-100 rounded overflow-hidden shadow-lg hover:shadow-2xl pt-4">
		<div class="px-6 py-4">
		</div>
	</div>
</div>
 </section> <section class="news-block-inverse px-6 py-4"> </section> <?$APPLICATION->IncludeComponent(
	"stores.list", 
	"inner_items_template",
	array(
		"COMPONENT_TEMPLATE" => "inner_items_template",
		"IBLOCK_TYPE" => "Salons",
		"IBLOCK_ID" => "4",
		"DISPLAY_MAP" => "N",
		"NEWS_COUNT" => "3",
		"URL_ALL" => "",
		"SORT_BY1" => "DATE_CREATE",
		"SORT_ORDER1" => "DESC",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>