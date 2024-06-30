<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<div class="blog-posts">

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	$dateFormatted = FormatDate("j F", MakeTimeStamp($arItem["DATE_CREATE"]), "en");
	?>
	<div class="post" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<img src="<?= CFile::GetPath($arItem["PREVIEW_PICTURE"]["ID"]);?>">
		<div class="post-content">
			<h3><?= $arItem["NAME"];?></h3>
			<p><?= $arItem["PREVIEW_TEXT"]; ?></p>
			<div class="post-meta">
			<img src="<?= CFile::GetPath($arItem["DETAIL_PICTURE"]["ID"]); ?>">
				<div class="meta-info">
					<span><?= $arItem["DETAIL_TEXT"];?></span>
					<span class="job"><?=$arItem['PROPERTIES']['JOB']['VALUE'];?></span>
				</div>
				<span class="date"><?=$dateFormatted;?></span>
			</div>
		</div>
	</div>
<?endforeach;?>

</div>