<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
// echo "<pre>";
// var_dump($arResult);
// echo "</pre>";
?>
<div class="link">
    <div class="container">
        <a href="/test/"><?=getMessage('ALL');?></a>
        <a href="/test/?id=edible"><?=getMessage('EDIBLE');?></a>
        <a href="/test/?id=edibleno"><?=getMessage('EDIBLENO');?></a>
    </div>
</div>
<hr>
<div class="wrapper">
<?foreach($arResult['ITEMS'] as $arItem):?>
<?
$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
<div class="container" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
    <div class="item">
        <div><img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt=""></div>
        <h1 class="title"><?=$arItem['NAME']?></h1>
        <p><?=getMessage('COLOR');?> <?=$arItem['PROPERTY_COLOR_VALUE']?></p>
        <p>
            <? if ($arItem['PROPERTY_EDIBLE_VALUE'] == 'Y') : ?>
                <span><?=getMessage('EDIBLE');?></span>
            <? else : ?>
                <span><?=getMessage('EDIBLENO');?></span>
            <? endif; ?>
        </p>
    </div>
</div>
<?endforeach;?>
</div>
<div class="pag">
    <?=$arResult['NAV_STRING'];  ?>
</div>
</div>
