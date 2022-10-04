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
	"bitrix:news.list",
	"",
Array()
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>