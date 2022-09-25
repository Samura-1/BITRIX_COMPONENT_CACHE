<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Рога и Сила");
?><?$APPLICATION->IncludeComponent(
	"qsoft:main.banner",
	"",
	Array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"NOINDEX" => "N",
		"QUANTITY" => "3",
		"TYPE" => "main_baner"
	)
);?> <section class="pb-4 px-6">
<p class="inline-block text-3xl text-black font-bold mb-4">
	 Модели недели
</p>
<div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-6">
	<div class="bg-white w-full border border-gray-100 rounded overflow-hidden shadow-lg hover:shadow-2xl pt-4">
 <a class="block w-full h-40" href="detail.html"><img alt="Cerato" src="<?=DEFAULT_TEMPLATE_ASSETS?>pictures/car_cerato.png" class="w-full h-full hover:opacity-90 object-cover"></a>
		<div class="px-6 py-4">
			<div class="text-black font-bold text-xl mb-2">
 <a class="hover:text-orange" href="detail.html">Cerato</a>
			</div>
			<p class="text-grey-darker text-base">
 <span class="inline-block">1 221 900 ₽</span><span class="inline-block line-through pl-6 text-gray-400">1 821 900 ₽</span>
			</p>
		</div>
	</div>
	<div class="bg-white w-full border border-gray-100 rounded overflow-hidden shadow-lg hover:shadow-2xl pt-4">
 <a class="block w-full h-40" href="detail.html"><img alt="Rio X" src="<?=DEFAULT_TEMPLATE_ASSETS?>pictures/car_rio-x.png" class="w-full h-full hover:opacity-90 object-cover"></a>
		<div class="px-6 py-4">
			<div class="text-black font-bold text-xl mb-2">
 <a class="hover:text-orange" href="detail.html">Rio X</a>
			</div>
			<p class="text-grey-darker text-base">
 <span class="inline-block">969 900 ₽</span>
			</p>
		</div>
	</div>
	<div class="bg-white w-full border border-gray-100 rounded overflow-hidden shadow-lg hover:shadow-2xl pt-4">
 <a class="block w-full h-40" href="detail.html"><img alt="Mohave" src="<?=DEFAULT_TEMPLATE_ASSETS?>pictures/car_mohave_new.png" class="w-full h-full hover:opacity-90 object-cover"></a>
		<div class="px-6 py-4">
			<div class="text-black font-bold text-xl mb-2">
 <a class="hover:text-orange" href="detail.html">Mohave</a>
			</div>
			<p class="text-grey-darker text-base">
 <span class="inline-block">3 549 900 ₽</span>
			</p>
		</div>
	</div>
	<div class="bg-white w-full border border-gray-100 rounded overflow-hidden shadow-lg hover:shadow-2xl pt-4">
 <a class="block w-full h-40" href="detail.html"><img alt="K5" src="<?=DEFAULT_TEMPLATE_ASSETS?>pictures/car_K5-half.png" class="w-full h-full hover:opacity-90 object-cover"></a>
		<div class="px-6 py-4">
			<div class="text-black font-bold text-xl mb-2">
 <a class="hover:text-orange" href="detail.html">K5</a>
			</div>
			<p class="text-grey-darker text-base">
 <span class="inline-block">1 577 900 ₽</span>
			</p>
		</div>
	</div>
</div>
 </section> <section class="news-block-inverse px-6 py-4">
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"news_list_main",
	Array(
		"ACTIVE_DATE_FORMAT" => "j M Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "news_list_main",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"TAGS",1=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "news",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "3",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "150",
		"PROPERTY_CODE" => array(0=>"",1=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?> </section> <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>