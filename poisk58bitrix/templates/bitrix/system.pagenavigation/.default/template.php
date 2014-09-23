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

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

//echo "<pre>"; print_r($arResult);echo "</pre>";

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

 preg_match('|[^?]+|', $APPLICATION->GetCurUri(), $match);
 $uri = $match[0];
?>
<?$count = $_GET['count'];?>

<div class="col-md-3 col-sm-4 col-xs-4 col-xss-6">
	<div class="logo-pagecount">
		<img class="pagcont-logo" src="/upload/iblock/d00/d0071eff7c249769c5cb061825adab07.png"alt="info">
			<div class="pagecount-wrap">
				<span class="pagecount">
					
				</span>
			</div>
	</div>
</div>	

<div class="col-md-6 col-sm-8  col-xs-8 col-xss-6">
		<p id="sh-more" class="show-more" onclick="get()">
			<i class="glyphicon glyphicon-refresh"></i>
				Показать еще
		</p>
</div>
<script>

function get(){

<?
	if(!empty($_GET['count']))
	{
		echo "count = {$_GET['count']};";
	}
	else echo "var count = 16;";
?>
	 col =parseInt(count) + 16;
	
	$('#sh-more').html('Загрузка');
	
	BX.ajax.get('<?=$uri?>?count='+col+'&maxinfo='+<?=$arResult["NavRecordCount"]?>);
}

<?
	if(!empty($_GET['count']))
	{
		echo "col = {$_GET['count']};";
	}
	else echo "var col = 16;";
?>

if(col < <?=$arResult["NavRecordCount"]?>)
{
	$('.pagecount').html(col+' из <?=$arResult["NavRecordCount"]?>');
	$('#sh-more').html('<i class="glyphicon glyphicon-refresh"></i>Показать еще');
}
else
{
	$('.pagecount').html(<?=$arResult["NavRecordCount"]?>+' из <?=$arResult["NavRecordCount"]?>');
	$('.show-more').html('Конец');
	$('.show-more').attr('onclick', 'return false');
}
</script>

	