<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
use Bitrix\Iblock,
    Bitrix\Main\Loader,
    Bitrix\Main\Application;
class Salons extends CBitrixComponent
{
    private $filter;
    protected $request;
    private function _checkModules()
    {
        if (!Loader::includeModule("iblock")) {
            $this->abortResultCache();
            ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
            return;
        }
    }
    private function app()
    {
        global $APPLICATION;
        return $APPLICATION;
    }
    public function onPrepareComponentParams($params): array
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
        $this->app();
            if (Loader::includeModule("iblock")) {
                $arButtons = CIBlock::GetPanelButtons(
                    $this->arParams["IBLOCK_ID"],
                    0,
                    0,
                    ["SECTION_BUTTONS"=>false],
            );

            if ($this->app()->GetShowIncludeAreas()) {
                $this->AddIncludeAreaIcons(CIBlock::GetComponentMenu($this->app()->GetPublicShowMode(), $arButtons));
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

        $arResult["ITEMS"] = [];
        $arrayImgItem["PREVIEW_PICTURE_ID"] = [];

        $res = CIBlockElement::GetList([], $arFilter, false, ["nPageSize" => $this->arParams['COUNT'], "bShowAll" => false], $arSelect);

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
            $arResult["NAV_STRING"] = $res->GetPageNavStringEx($navComponentObject, "", 'modern');
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

        return $arResult;
    }

    public function executeComponent()
    {
        $this->request = Application::getInstance()->getContext()->getRequest();
        if ($this->startResultCache(false, [[$this->request->get('id') === 'edible'], [$this->request->get('id') === 'edibleno'], [$this->request->get('PAGEN_1')]])) {
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
