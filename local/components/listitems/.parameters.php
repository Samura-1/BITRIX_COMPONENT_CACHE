<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

if(!CModule::IncludeModule("iblock")) {
    return;
}

$iblockTypes = CIBlockParameters::GetIBlockTypes();

$arIBlocks = [];
$db_iblock = CIBlock::GetList(array("SORT"=>"ASC"),
	array("SITE_ID" => $_REQUEST["site"],
		"TYPE" => ($arCurrentValues["IBLOCK_TYPE"] != "-" ? $arCurrentValues["IBLOCK_TYPE"] : "")
	)
);

while($arRes = $db_iblock->Fetch()) {
    $arIBlocks[$arRes["ID"]] = "[".$arRes["CODE"]."] ".$arRes["NAME"];
}

$arComponentParameters = [
    "PARAMETERS" => [
        "IBLOCK_TYPE" => [
            "PARENT" => "BASE",
            "NAME" => GetMessage("T_IBLOCK_LIST_TYPE"),
            "TYPE" => "LIST",
            "VALUES" => $iblockTypes,
            "DEFAULT" => "orders",
            "REFRESH" => "Y",
        ],
        "IBLOCK_ID" => [
            "PARENT" => "BASE",
            "NAME" => GetMessage("T_IBLOCK_DESC_LIST_ID"),
            "TYPE" => "LIST",
            "VALUES" => $arIBlocks,
            "DEFAULT" => " ",
            "REFRESH" => "Y",
        ],
        "COUNT" => [
            "PARENT" => "BASE",
            "NAME" => GetMessage("T_IBLOCK_DESC_LIST_CONT"),
            "TYPE" => "STRING",
            "DEFAULT" => "2",
        ],
        "CACHE_TIME" => [
            "DEFAULT"=> 3600,
        ],
    ],
];
CIBlockParameters::Add404Settings($arComponentParameters, $arCurrentValues);
