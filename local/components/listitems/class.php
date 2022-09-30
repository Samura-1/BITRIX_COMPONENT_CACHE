<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
use Bitrix\Iblock,
    Bitrix\Main\Loader;
class Salons extends CBitrixComponent
{
    public $filter;
    public function onPrepareComponentParams($params)
    {
        if (empty($params['COUNT'])) {
            $params['COUNT'] = 2;
        }
        if (!isset($params["CACHE_TIME"])) {
            $params["CACHE_TIME"] = 3600;
        }
        return $params;
    }
    private function getButtonAdd()
    {
        global $APPLICATION;
            if (Loader::includeModule("iblock")) {
                $arButtons = CIBlock::GetPanelButtons(
                    $this->arParams["IBLOCK_ID"],
                    0,
                    0,
                    ["SECTION_BUTTONS"=>false],
            );

            if($APPLICATION->GetShowIncludeAreas()){
                $this->AddIncludeAreaIcons(CIBlock::GetComponentMenu($APPLICATION->GetPublicShowMode(), $arButtons));
            }
        }
    }
    public function getSalons()
    {
        $arSelect = [
            "ID",
            "IBLOCK_ID",
            "NAME",
            "PREVIEW_PICTURE",
            "PROPERTY_COLOR",
            "PROPERTY_EDIBLE",
        ];
        //WHERE
        $arFilter = [
            "IBLOCK_ID" => intval($this->arParams["IBLOCK_ID"]),
            "ACTIVE" => "Y",
        ];
        if (isset($this->filter)) {
            $arFilter[] = $this->filter;
        }

        $arResult["ITEMS"] = [];
        $img_item["PREVIEW_PICTURE_ID"] = [];

        $res = CIBlockElement::GetList([], $arFilter, false, ["nTopCount" => $this->arParams["COUNT"]], $arSelect);

        while ($row = $res->GetNext(true, false)) {
            $arButtons = CIBlock::GetPanelButtons(
                $row["IBLOCK_ID"],
                $row["ID"],
                0,
                ["SECTION_BUTTONS" => false, "SESSID" => false]
            );
            $row["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
            $row["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

            $arResult["ITEMS"][$row["ID"]] = $row;

            if ($row['PREVIEW_PICTURE']) {
                $img_item['PREVIEW_PICTURE_ID'][$row["ID"]] = (int)$arResult['ITEMS'][$row["ID"]]['PREVIEW_PICTURE'];
            }
        }
        unset($row);

        if (!empty($img_item['PREVIEW_PICTURE_ID'])) {
            $dbfiles = CFile::GetList(false, ["@ID" => $img_item['PREVIEW_PICTURE_ID']]);

            while ($image = $dbfiles->GetNext()) {
                $imges[$image['ID']]['SRC'] = CFile::GetFileSRC($image);
            }
            foreach ($arResult['ITEMS'] as $key => &$item) {
                if (isset($img_item, $item['PREVIEW_PICTURE'])) {
                    $item['PREVIEW_PICTURE'] = $imges[$item['PREVIEW_PICTURE']];
                }
            }
        }
        return $arResult;
    }

    public function executeComponent()
    {
        if ($this->startResultCache(false, $_GET['id'])) {
            if (!Loader::includeModule("iblock")) {
                $this->abortResultCache();
                ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
                return;
            }
            switch ($_GET['id'])
            {
                default:
                    break;
                case 'edible' :
                    $this->filter = ['!PROPERTY_EDIBLE' => false];
                    break;
                case 'edibleno' :
                    $this->filter = ['PROPERTY_EDIBLE' => false];
                    break;
            }
            $this->arResult = $this->getSalons();
            $this->setResultCacheKeys($this->arResult);
            $this->includeComponentTemplate();
        }
        $this->getButtonAdd();
    }
}
