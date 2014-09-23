<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	   
<?define('BEGINCOL', 16);?>

<?/*Выборка свойств из инфоблока услуги*/
 if(CModule::IncludeModule("iblock"))
 {
    $db_props = CIBlockElement::GetProperty(2, 7, "sort", "asc", array());
    $PROPS = array();
    while($ar_props = $db_props->Fetch()) {
            $PROPS[$ar_props['NAME']] = CFile::GetPath($ar_props['VALUE']);
    }
 }
?>


<div id="rowcnt" class="row">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?/*=$arResult["NAV_STRING"]*/?>
<?endif;?>

<?if(empty($_GET['count'])):?>
	<?/*начальное количество новостей */
		$infocol = BEGINCOL;
		$num = 1;
	?>
		<?foreach($arResult["ITEMS"] as $arResult["ITEMS"][$num]):?>
				<?if($num <= $infocol):?>
						<?
						$this->AddEditAction($arResult["ITEMS"][$num]['ID'], $arResult["ITEMS"][$num]['EDIT_LINK'], CIBlock::GetArrayByID($arResult["ITEMS"][$num]["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arResult["ITEMS"][$num]['ID'], $arResult["ITEMS"][$num]['DELETE_LINK'], CIBlock::GetArrayByID($arResult["ITEMS"][$num]["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>
						<div class="col-md-3 col-sm-4 col-xs-4 col-xss-6">
							<div class="mesta-wrap">
								<div class="mesta">
									<div class="logo-info">
									<?
										/*Достаем фотоидентификаторы*/
										$fotoid = $arResult["ITEMS"][$num]['PROPERTIES']['PLACE_FOTO_IDENTIF']['VALUE_XML_ID'];
										
										foreach($PROPS as $id => $path)
										{
											if((string) $id === (string) $fotoid)
											{
											   $psrc = $path;

											}
										} 
									?>
										<img src="<?=$psrc?>" alt="info">
									</div>
									
										<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["ITEMS"][$num]["PREVIEW_PICTURE"])):?>
											<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arResult["ITEMS"][$num]["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
												<a class="infob-Img" href="<?=$arResult["ITEMS"][$num]["DETAIL_PAGE_URL"]?>" style="background: url(<?=$arResult["ITEMS"][$num]["PREVIEW_PICTURE"]["SRC"]?>) 0 0; -o-background-size: cover; -moz-background-size: cover; -webkit-background-size:cover; background-size:cover;">
													<?/*=$arResult["ITEMS"][$num]["PREVIEW_PICTURE"]["SRC"]*/?>
													<img src="/images/dummy10x10.gif" title="<?=$arResult["ITEMS"][$num]["NAME"]?>" alt="<?=$arResult["ITEMS"][$num]["NAME"]?>" class="picture-mesta">
												</a>
											<?else:?>
												<?/*=$arResult["ITEMS"][$num]["PREVIEW_PICTURE"]["SRC"]*/?>
												<img src="/images/dummy10x10.gif" title="<?=$arResult["ITEMS"][$num]["NAME"]?>" alt="<?=$arResult["ITEMS"][$num]["NAME"]?>" class="picture-mesta">
											<?endif;?>
										<?endif?>
												
												<p class="linetext">
													<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["ITEMS"][$num]["NAME"]):?>
														<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arResult["ITEMS"][$num]["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
															<a href="<?echo $arResult["ITEMS"][$num]["DETAIL_PAGE_URL"]?>"><?echo $arResult["ITEMS"][$num]["NAME"]?></a>
														<?else:?>
															<?echo $arResult["ITEMS"][$num]["NAME"]?>
														<?endif;?>
													<?endif;?>
												</p>
												
												<div class="descript-wrap">
													<p class="description">
														<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["ITEMS"][$num]["DISPLAY_ACTIVE_FROM"]):?>
															<span class="news-date-time"><?echo $arResult["ITEMS"][$num]["DISPLAY_ACTIVE_FROM"]?></span>
														<?endif?>
														
														<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["ITEMS"][$num]["PREVIEW_TEXT"]):?>
															<?echo $arResult["ITEMS"][$num]["PREVIEW_TEXT"];?>
														<?endif;?>
														
														<?foreach($arResult["ITEMS"][$num]["FIELDS"] as $code=>$value):?>
															<strong>
															<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
															</strong>
														<?endforeach;?>
														<?foreach($arResult["ITEMS"][$num]["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
															<strong>
																<nobr>
																	<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
																		<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
																	<?else:?>
																		<?=$arProperty["DISPLAY_VALUE"];?>
																	<?endif?>
																</nobr>
															</strong>
														<?endforeach;?>
													</p>
													<i class="glyph-btn glyphicon glyphicon-plus"></i>
													<span class="tooltip-mesta"><nobr>в любимые места</nobr></span>
												</div>	
								</div><!--mesta-->
							</div><!--mesta-wrap-->	
						</div><!--col-md-3 col-sm-4 col-xs-4 col-xss-6-->
						<?$num++?>
				<?endif?>		
		<?endforeach;?>
<?endif?>
	
</div><!--row-->


<div class="row">
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
		
</div><!--row-->

<?if(!empty($_GET['count'])):?>
	<script>
		var str = '';
		<?$num = $_GET['count'] - BEGINCOL?>
	<?$len = $_GET['count']?>
	//console.log( 'num=<?=$num?>|len=<?=$len?>|maxinfo=<?=$_GET['maxinfo']?>');
			<?for(;$num < $len && $num< $_GET['maxinfo']; $num++):?>
			
					<?
				$this->AddEditAction($arResult["ITEMS"][$num]['ID'], $arResult["ITEMS"][$num]['EDIT_LINK'], CIBlock::GetArrayByID($arResult["ITEMS"][$num]["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arResult["ITEMS"][$num]['ID'], $arResult["ITEMS"][$num]['DELETE_LINK'], CIBlock::GetArrayByID($arResult["ITEMS"][$num]["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
	str ='<div class="col-md-3 col-sm-4 col-xs-4 col-xss-6">'+
						'<div class="mesta-wrap">'+
							'<div class="mesta">'+
								'<div class="logo-info">'+
								'<?
										/*Достаем фотоидентификаторы*/
										$fotoid = $arResult["ITEMS"][$num]['PROPERTIES']['PLACE_FOTO_IDENTIF']['VALUE_XML_ID'];
										
										foreach($PROPS as $id => $path)
										{
											if((string) $id === (string) $fotoid)
											{
											   $psrc = $path;

											}
										} 
									?>'+
									'<img src="<?=$psrc?>" alt="info">'+
								'</div>'+
								
									'<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["ITEMS"][$num]["PREVIEW_PICTURE"])):?>'+
										'<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arResult["ITEMS"][$num]["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>'+
											'<a class="infob-Img"  style="background: url(<?=$arResult["ITEMS"][$num]["PREVIEW_PICTURE"]["SRC"]?>) 0 0; -o-background-size: cover; -moz-background-size: cover; -webkit-background-size:cover; background-size:cover;"  href="<?=$arResult["ITEMS"][$num]["DETAIL_PAGE_URL"]?>">'+
												'<img src="/images/dummy10x10.gif" title="<?=$arResult["ITEMS"][$num]["NAME"]?>" alt="<?=$arResult["ITEMS"][$num]["NAME"]?>" class="picture-mesta">'+
											'</a>'+
										'<?else:?>'+
											'<img src="<?=$arResult["ITEMS"][$num]["PREVIEW_PICTURE"]["SRC"]?>" title="<?=$arResult["ITEMS"][$num]["NAME"]?>" alt="<?=$arResult["ITEMS"][$num]["NAME"]?>" class="picture-mesta">'+
										'<?endif;?>'+
									'<?endif?>'+
											
											'<p class="linetext">'+
												'<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["ITEMS"][$num]["NAME"]):?>'+
													'<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arResult["ITEMS"][$num]["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>'+
														'<a href="<?echo $arResult["ITEMS"][$num]["DETAIL_PAGE_URL"]?>"><?echo $arResult["ITEMS"][$num]["NAME"]?></a>'+
													'<?else:?>'+
														'<?echo $arResult["ITEMS"][$num]["NAME"]?>'+
													'<?endif;?>'+
												'<?endif;?>'+
											'</p>'+
											
											'<div class="descript-wrap">'+
												'<p class="description">'+
													'<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["ITEMS"][$num]["DISPLAY_ACTIVE_FROM"]):?>'+
														'<span class="news-date-time"><?echo $arResult["ITEMS"][$num]["DISPLAY_ACTIVE_FROM"]?></span>'+
													'<?endif?>'+
													
													'<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["ITEMS"][$num]["PREVIEW_TEXT"]):?>'+
														'<?echo $arResult["ITEMS"][$num]["PREVIEW_TEXT"];?>'+
													'<?endif;?>'+
													
													'<?foreach($arResult["ITEMS"][$num]["FIELDS"] as $code=>$value):?>'+
														'<strong>'+
														'<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>'+
														'</strong>'+
													'<?endforeach;?>'+
													'<?foreach($arResult["ITEMS"][$num]["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>'+
														'<strong>'+
															'<nobr>'+
																'<?if(is_array($arProperty["DISPLAY_VALUE"])):?>'+
																	'<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>'+
																'<?else:?>'+
																	'<?=$arProperty["DISPLAY_VALUE"];?>'+
																'<?endif?>'+
															'</nobr>'+
														'</strong>'+
													'<?endforeach;?>'+
												'</p>'+
												'<i class="glyph-btn glyphicon glyphicon-plus"></i>'+
												'<span class="tooltip-mesta"><nobr>в любимые места</nobr></span>'+
											'</div>'+	
								'</div>'+<!--mesta-->
							'</div>'+<!--<mesta-wrap-->
						'</div>';<!--col-md-3 col-sm-4 col-xs-4 col-xss-6-->
				
					$('#rowcnt').html(function(index, currentValue){
					return currentValue +str;});	

			<?endfor?>
	</script>	
<?endif?>	
