<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
use Bitrix\Iblock,
    Bitrix\Main\Loader,
    Bitrix\Main\Application;
class Salons extends CBitrixComponent
{
    protected $filter;
    protected $request;
    protected $arNavigation;
    protected $arNavParams;
    private function _checkModules()
    {
        if (!Loader::includeModule("iblock")) {
            $this->abortResultCache();
            ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
            return;
        }
    }
    public function onPrepareComponentParams($arParams): array
    {
        if (empty($arParams['COUNT'])) {
            $arParams['COUNT'] = 2;
        }
        if (!isset($arParams["CACHE_TIME"])) {
            $arParams["CACHE_TIME"] = 3600;
        }
        return $arParams;
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

    public function getSalons(): array
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
        $this->arNavParams = [
            "nPageSize" => $this->arParams["COUNT"],
            "bDescPageNumbering" => 'N',
            "bShowAll" => false,
        ];
        if($this->arNavigation["PAGEN"] == 0 && $this->arParams["CACHE_TIME"] > 0) {
            $this->arParams["CACHE_TIME"] = 36000;
        }
        $arResult["ITEMS"] = [];
        $arrayImgItem["PREVIEW_PICTURE_ID"] = [];

        $res = CIBlockElement::GetList([], $arFilter, false, $this->arNavParams, $arSelect);

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
                $arrayImgItem['PREVIEW_PICTURE_ID'][$row["ID"]] = (int)$arResult['ITEMS'][$row["ID"]]['PREVIEW_PICTURE'];
            }
        }
        unset($row);

        if (!empty($arrayImgItem['PREVIEW_PICTURE_ID'])) {
            $arrayImg = [];
            $dbFiles = CFile::GetList(false, ["@ID" => $arrayImgItem['PREVIEW_PICTURE_ID']]);
            while ($image = $dbFiles->GetNext()) {
                $arrayImg[$image['ID']]['SRC'] = CFile::GetFileSRC($image);
            }
            foreach ($arResult['ITEMS'] as $key => $item) {
                if (isset($arrayImgItem, $item['PREVIEW_PICTURE'])) {
                    $arResult['ITEMS'][$key]['PREVIEW_PICTURE'] = $arrayImg[$item['PREVIEW_PICTURE']];
                }
            }
        }
        $arResult["NAV_STRING"] = $res->GetPageNavStringEx($navComponentObject, "", 'modern');
        return $arResult;
    }

    public function executeComponent()
    {
        CPageOption::SetOptionString("main", "nav_page_in_session", "N");
        $this->arNavigation = CDBResult::GetNavParams($this->arNavParams);
        $this->request = Application::getInstance()->getContext()->getRequest();
        if ($this->startResultCache(false, [[$this->request->get('id') => 'edible','edibleno'], $this->arNavigation])) {
            $this->_checkModules();

            switch ($this->request->get('id'))
            {
                case 'edible' :
                    $this->filter = ['!PROPERTY_EDIBLE' => false];
                    break;
                case 'edibleno' :
                    $this->filter = ['PROPERTY_EDIBLE' => false];
                    break;
            }

            $this->arResult = $this->getSalons();
            $this->setResultCacheKeys([]);
            $this->includeComponentTemplate();
        }
        $this->getButtonAdd();
    }
}

