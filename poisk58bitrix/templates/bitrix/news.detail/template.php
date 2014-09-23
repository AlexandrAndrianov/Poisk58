<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->SetViewTarget('class');?>
   white
<?$this->EndViewTarget();?>
<?if($_GET['key'] != 'fotoload'):?>
		<?$APPLICATION->AddHeadString('
				<script type="text/javascript" src="'.SITE_TEMPLATE_PATH.'/js/vk_like.js"></script>
				<script type="text/javascript">
					  VK.init({apiId: 4269851, onlyWidgets: true});
					</script>', true);
		?>

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
		
		<?/*Получаем элементы сети для кнопки Сеть*/
			$flagnet = !empty($arResult['PROPERTIES']['PROP_NETWORK']['VALUE']);
			$strNetw = $arResult['PROPERTIES']['PROP_NETWORK']['VALUE'];
			if($flagnet){
				if(CModule::IncludeModule("iblock")){
					$arRezNetw = Array();
					$db_netw = CIBlockElement::GetList(Array(), Array('PROPERTY_PROP_NETWORK'=>$strNetw));
					while($arNetw = $db_netw->GetNext()){
						$db_info = CIBlockElement::GetProperty($arParams['IBLOCK_ID'], $arNetw['ID'],
												Array(), Array('CODE' => 'PLACE_ADRES'));
						$arinfoRez = $db_info->Fetch();
						$arREzNetw[] = Array($arNetw['NAME'], $arinfoRez['VALUE'], 
																	$arNetw['LIST_PAGE_URL'].$arNetw['DETAIL_PAGE_URL']);
					}
					$cntNetw = count($arREzNetw);
				}
			}
		?>

		<div class="row mrg-bot15 vs991 hd335">

			<div class="col-sm-3 col-xs-3">
				<p class="favor_more-sm">
					<i class="glyph-more-sm glyphicon glyphicon-plus"></i>
					<span><nobr>в любимые места</nobr></span>
				</p>
			</div>
			
			<div class='col-sm-3 col-xs-3 col-sm-ofset-6 col-xs-offset-6'>
				<div class="vk_like991-wrap">
					<div id="vk_like991"></div>
					
						<script type="text/javascript">
							VK.Widgets.Like991("vk_like991", {type: "button", height: 24});
						</script>
			
				</div>
			</div>
			
			<div class="col-sm-12 col-xs-12">
				<div class="name_mesto-sm">
					<h4><?=$arResult["NAME"];?></h4>
					<div class="btn-vote-wrap991">
						<a class="btn btn-primary" href="javascript:void(0);">7.4<sup>/45<sup></a>
						<a class="btn btn-primary" href="javascript:void(0);">
							<i class="glyphicon glyphicon-thumbs-up"></i>
						</a>
					</div>
				</div>
			</div>
			
		</div>

		<div class="row vs335">
			<div class="col-md-3">
				<a class="mrg-bot15 btn btn-danger btn-xs" href="javascript:void(0);">Фильтр</a>
				<a class="mrg-bot15 btn btn-danger btn-xs" href="javascript:void(0);">Фильтр</a>
				<a class="mrg-bot15 btn btn-danger btn-xs" href="javascript:void(0);">Фильтр</a>
				<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
					<p class="linetext335">
						<?=$arResult["NAME"]?>
					</p>
				<?endif;?>
			</div>
		</div>
				
				
		<div class="row">
			<div class="col-md-3">
				<div class="mesta-wrap mesta-hd-vs">
					<div class="mesta">
						
							<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
							<a class="infob-Img" href="javascript:void(0);" style="background: url(<?=$arResult["DETAIL_PICTURE"]["SRC"]?>) 0 0;  -o-background-size: cover; -moz-background-size: cover; -webkit-background-size:cover; background-size:cover;">
								<img src="/images/dummy10x10.gif" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" class="picture-mesta">
							</a>
							<?endif?>
							<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
								<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
							<?endif;?>
							<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
								<p class="linetext-hd">
									<?=$arResult["NAME"]?>
								</p>
							<?endif;?>
							
							<div class="descript-wrap">
								<p class="description">
									<span><nobr>в любимые места</nobr></span>
								</p>
								<i class="glyph-btn glyphicon glyphicon-plus"></i>
								<span class="tooltip-mesta"><nobr>в любимые места</nobr></span>
							</div>	
					</div>
				</div>
			</div>
			
			<div class="col-md-9">
					<div class="panoram-wrap panoram-hd-vs">
						<div class="panoram">
							<div class="filtr-panor">
								<a class="btn btn-danger btn-xs" href="javascript:void(0);">Фильтр</a>
								<a class="btn btn-danger btn-xs" href="javascript:void(0);">Фильтр</a>
								<a class="btn btn-danger btn-xs" href="javascript:void(0);">Фильтр</a>
							</div>
							 <?/*картинка панорамы*/
								$arFile = CFile::GetFileArray($arResult['PROPERTIES']['PLACE_PANORAMA']['VALUE']);
							 ?>
							 <a class="infob-Img" href="javascript:void(0);" style="background: url(<?=$arFile[SRC]?>) 0 0;  -o-background-size: cover; -moz-background-size: cover; -webkit-background-size:cover; background-size:cover;">
								<img src="/images/dummy512x150.gif" alt="<?=$arResult["FIELDS"]["PREVIEW_TEXT"]?>" class="picture-mesta">
							</a>	
							<div class="bookmark-btn">
								<a onclick="displCont(this)" class="<?=($_GET['key'] == 'inter' ? 'btn btn-default hd569':'btn btn-primary hd569')?>" 
									data="descr" href="javascript:void(0);">Описание</a>
								<a onclick="displCont(this)" class="<?=($_GET['key'] == 'inter' ? 'btn btn-primary hd569':'btn btn-default hd569')?>"
									data="inter" href="javascript:void(0);">Интерьер</a>
								<a onclick="displCont(this)" class="btn btn-default hd569" data="map" href="javascript:void(0);">Карта</a>
								<a onclick="displCont(this)" class="btn btn-default hd569" data="menu"  href="javascript:void(0);">Меню</a>
								
								<div class="vs569">	
									<div class="btn-group">
										  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Описание<span class="caret"></span></button>
										  <ul class="dropdown-menu" role="menu">
												<li class="<?=($_GET['key'] == 'inter' ? '':'bookmark-active')?>"><a  onclick="displCont(this)" href="javascript:void(0)" data="descr">Описание</a></li>
												<li class="<?=($_GET['key'] == 'inter' ? 'bookmark-active':'')?>"><a onclick="displCont(this)" href="javascript:void(0)" data="inter">Интерьер</a></li>
												<li><a onclick="displCont(this)" href="javascript:void(0)" data="map">Карта</a></li>
												<li><a onclick="displCont(this)" href="javascript:void(0)" data="menu">Меню</a></li>
										  </ul>
									</div>
								</div>	
							</div>

							<?if($flagnet):?>
								<div class="bookmark-btn-right">
									<a class="btn btn-primary" href="javascript:void(0);" data="network"
											onclick="displCont(this)">
										Сеть
										<span class="col_network">
											<?=$cntNetw?>
										</span>
									</a>
								</div>
							<?endif?>
						</div>
					</div>
					
					<div class="name_mesto hd991">
						<h4><?=$arResult["NAME"];?></h4>
					</div>
			</div>
						
						<?/*if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
							<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
						<?endif;?>
						<?if($arResult["NAV_RESULT"]):?>
							<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
							<?echo $arResult["NAV_TEXT"];?>
							<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
						<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
							<?echo $arResult["DETAIL_TEXT"];?>
						<?else:?>
							<?echo $arResult["PREVIEW_TEXT"];?>
						<?endif*/?>
						
		</div>


		<div class="row vs335">
						
			<div class="col-md-3 ">
				<div class="btn-group ">
					  <button type="button" class="btn btn-primary dropdown-toggle 335" data-toggle="dropdown">Описание<span class="caret"></span></button>
					  <ul class="dropdown-menu" role="menu">
						<li  class="<?=($_GET['key'] == 'inter' ? '':'bookmark-active')?>"><a  onclick="displCont(this)" href="javascript:void(0)" data="descr">Описание</a></li>
						<li class="<?=($_GET['key'] == 'inter' ? 'bookmark-active':'')?>"><a  onclick="displCont(this)" href="javascript:void(0)" data="inter">Интерьер</a></li>
						<li><a  onclick="displCont(this)" href="javascript:void(0)" data="map">Карта</a></li>
						<li><a  onclick="displCont(this)" href="javascript:void(0)" data="menu">Меню</a></li>
						<?if($flagnet):?>
							<li><a  onclick="displCont(this)" href="javascript:void(0)" data="network">
										Сеть <?=$cntNetw?>
									</a>
							</li>
						<?endif?>	
					  </ul>
				</div>
			</div>
			
		</div>	
						

		<div class="row mrg-bot15">
			
				<div class="col-md-3 clearfix hd991">
					<div class="vote-btn col-sm-6 col-xs-6">
						<a class="btn btn-primary btn-block" href="javascript:void(0);">7.4<sup>/45<sup></a>
						<a class="btn btn-default btn-block" href="javascript:void(0);">Параметр оценки</a>
						<a class="btn btn-default btn-block" href="javascript:void(0);">Параметр оценки</a>
						<a class="btn btn-default btn-block" href="javascript:void(0);">Параметр оценки</a>
						<a class="btn btn-primary btn-block" href="javascript:void(0);">Оценить место</a>
					</div>
				
						
					<div class="vk_like-wrap col-sm-6 col-xs-6">
						<p>рекомендовать Вконтакте</p>
						<div id="vk_like"></div>
			
							<script type="text/javascript">
							VK.Widgets.Like("vk_like", {type: "button", height: 24});
							</script>	
					
					</div>
				</div>
				<div id="afisha" class="col-md-9 mrg-top15vs991">
					<div id="descr" <?if($_GET['key'] == 'inter'):?> style="display: none;"<?endif?>>
						<div class="panel-group" id="accordion">
						  <div class="panel panel-default">
							<div class="panel-heading">
							  <h4 class="panel-title">
									<?=$arResult["DETAIL_TEXT"];?>
								  <a style="display:none;" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									Подробнее
								  </a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse in">
							  <div class="panel-body">
							  
								<?foreach($arResult["FIELDS"] as $code=>$value):
									if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
									{
										?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?
										if (!empty($value) && is_array($value))
										{
											?><img border="0" src="<?=$value["SRC"]?>" width="<?=$value["WIDTH"]?>" height="<?=$value["HEIGHT"]?>"><?
										}
									}
									else
									{
										?><?/*=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;*/?><?
									}
									?>
								<?endforeach;?>
								<?if(!empty($arResult["DISPLAY_PROPERTIES"]["PLACE_SITE"]["DISPLAY_VALUE"])):?>
									<?=$arResult["DISPLAY_PROPERTIES"]["PLACE_SITE"]["DISPLAY_VALUE"]?></br>
								<?endif?>
								<?if(!empty($arResult["DISPLAY_PROPERTIES"]["PLACE_ADRES"]["DISPLAY_VALUE"])):?>
									<?=$arResult["DISPLAY_PROPERTIES"]["PLACE_ADRES"]["DISPLAY_VALUE"]?></br>
								<?endif?>
								<?if(!empty($arResult["DISPLAY_PROPERTIES"]["PLACE_CONTACTS"]["DISPLAY_VALUE"])):?>
									<?=$arResult["DISPLAY_PROPERTIES"]["PLACE_CONTACTS"]["DISPLAY_VALUE"]?></br>
								<?endif?>
								<?if(!empty($arResult["DISPLAY_PROPERTIES"]["PLACE_WORK"]["DISPLAY_VALUE"])):?>
									<?=$arResult["DISPLAY_PROPERTIES"]["PLACE_WORK"]["DISPLAY_VALUE"]?></br>
								<?endif?>	
							  </div>
							</div>
								  <div class="panel-heading">
									  <h4 class="panel-title">
									  <?$str = '';?>
									  <?if(!empty($arResult["DISPLAY_PROPERTIES"]["PLACE_POSIDET_DOPOLNITELNO"]["VALUE_ENUM"])):?>
										  <?foreach($arResult["DISPLAY_PROPERTIES"]
																			["PLACE_POSIDET_DOPOLNITELNO"]["VALUE_ENUM"] as $key=>$value):?>
												<?$str .=$value.', ';?>
											<?endforeach?>
										
											<?$str=substr($str, 0, -2).';';?>
											<?=$str;?>
											
										  <?$str = '';?>
									<?endif?>
									<?if(!empty($arResult["DISPLAY_PROPERTIES"]["PLACE_POSIDET_VHOD"]["DISPLAY_VALUE"])):?>
										  <?=$arResult["DISPLAY_PROPERTIES"]["PLACE_POSIDET_VHOD"]["NAME"]?>:
										  <?=$arResult["DISPLAY_PROPERTIES"]["PLACE_POSIDET_VHOD"]["DISPLAY_VALUE"]?>;
									<?endif?>
									<?if(!empty($arResult["DISPLAY_PROPERTIES"]["PLACE_POSIDET_BIZNESLANCHVREMYA"]["DISPLAY_VALUE"])):?>
										  <?=$arResult["DISPLAY_PROPERTIES"]["PLACE_POSIDET_BIZNESLANCHVREMYA"]["NAME"]?>:
										  <?=$arResult["DISPLAY_PROPERTIES"]["PLACE_POSIDET_BIZNESLANCHVREMYA"]["DISPLAY_VALUE"]?>;
									<?endif?>
									<?if(!empty($arResult["DISPLAY_PROPERTIES"]["PLACE_POSIDET_VMESTIMOST"]["DISPLAY_VALUE"])):?>
											<?=$arResult["DISPLAY_PROPERTIES"]["PLACE_POSIDET_VMESTIMOST"]["NAME"]?>:
											<?=$arResult["DISPLAY_PROPERTIES"]["PLACE_POSIDET_VMESTIMOST"]["DISPLAY_VALUE"]?>
									<?endif?>
							
									<?if(!empty($arResult["DISPLAY_PROPERTIES"]["PLACE_POSIDET_KUCHNYA"]["VALUE_ENUM"])):?>						
										</br><?=$arResult["DISPLAY_PROPERTIES"]
																		["PLACE_POSIDET_KUCHNYA"]["NAME"]?>:
												<?foreach($arResult["DISPLAY_PROPERTIES"]
																				["PLACE_POSIDET_KUCHNYA"]["VALUE_ENUM"] as $key=>$value):?>
														<?$str .=$value.', ';?>
												<?endforeach?>
												<?$str=substr($str, 0, -2).';';?>
											<?=$str;?>
										</br>
										</br>
									<?endif?>
									<?if(!empty($arResult["DISPLAY_PROPERTIES"]["PLACE_POSIDET_CHEK"]["DISPLAY_VALUE"])):?>
										<?=$arResult["DISPLAY_PROPERTIES"]["PLACE_POSIDET_CHEK"]["NAME"]?>:
										<?=$arResult["DISPLAY_PROPERTIES"]["PLACE_POSIDET_CHEK"]["DISPLAY_VALUE"]?>
									<?endif?>
									<?if(!empty($arResult["DISPLAY_PROPERTIES"]["PLACE_MANY"]["VALUE_ENUM"])):?>
										<?$str = '';?>
										<?=$arResult["DISPLAY_PROPERTIES"]
																		["PLACE_MANY"]["NAME"]?>:
												<?foreach($arResult["DISPLAY_PROPERTIES"]
																				["PLACE_MANY"]["VALUE_ENUM"] as $key=>$value):?>
														<?$str.=$value.', '?>
												<?endforeach?>
												<?$str=substr($str, 0, -2).';';?>
												<?=$str;?>
									<?endif?>			
										</h4>
									</div>
						  </div>
						</div>
					</div>
						<?=$arResult["DISPLAY_PROPERTIES"]["MAP_CODE"]["DISPLAY_VALUE"];?>
							<div id="inter" <?if($_GET['key'] == 'inter'):?> style="display: block;"<?endif?>>
							<a name="inter"></a>
	<?endif?>						
								<?$APPLICATION->IncludeComponent(
										"andatr:fotogaleryLait",
										"",
										Array(
											"IBLOCK_TYPE" => "mesta",
											"IBLOCK_ID" => "4",
											"ELEMENT_ID" => $arResult["ID"],
											"MAXSIMB" => "100",
											"MAXFOTO" => "12",
											"PROPERTY_CODE" => "PHOTOGAL_LINK"
										)
									);?> 
	<?if($_GET['key'] != 'fotoload'):?>								
							</div>

							<div id="menu-list">
								<?$APPLICATION->IncludeComponent(
										"andatr:list",
										"",
										Array(
											"IBLOCK_TYPE" => "mesta",
											"IBLOCK_ID" => "4",
											"ELEMENT_ID" => $arResult["ID"],
										)
								);?>
							</div>
							
							<div id="network">
								<?
									foreach($arREzNetw as $key):?>
											<p class="netwP">
												<a href="<?=$key[2]?>">
													<span><?=$key[0]?>;</span> <?=$key[1]?>
												</a>
											</p>	
									
								<?endforeach?>
							</div>

				</div>	
		</div>
				<div class="row mrg-bot15 hd991">
					<div class="col-md-3 col-sm-4 col-xs-4 col-xss-6">
						<div class="btn-group">
						  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">Лента новостей <span class="caret"></span></button>
						  <ul class="dropdown-menu" role="menu">
								<li><a data-action="sobutiya" onclick="showAction(this);"
											href="javascript: void(0);">События</a></li>
								<li><a data-action="akcii" onclick="showAction(this);"
											href="javascript: void(0);">Акции</a></li>
								<li><a data-action="nowinki" onclick="showAction(this);" 
											href="javascript: void(0);">Новинки</a></li>
						  </ul>
						</div>
					</div>	
					
					<div class="col-md-3 col-sm-4 col-xs-4 col-xss-6 open">
						<button type="button" class="btn btn-default dropdown-toggle" 
							data-action="sobutiya" onclick="showAction(this);" data-toggle="dropdown">
							События
						</button>
						 
					</div>	
					
					<div class="col-md-3 col-sm-4 col-xs-4 col-xss-6">
						<button type="button" class="btn btn-default dropdown-toggle"
							data-action="akcii" onclick="showAction(this);" data-toggle="dropdown">
							Акции
						</button>
						 
					</div>	
					
					<div class="col-md-3 col-sm-4 col-xs-4 col-xss-6">
						<button type="button" class="btn btn-default dropdown-toggle" 
							data-action="nowinki" onclick="showAction(this);" data-toggle="dropdown">
							Новинки
						</button>
						 
					</div>	

				</div>
				
				
				<div class="row vs335">
					<div class="col-sm-12">
						<button type="button" class="btn btn-primary btn-block" data-toggle="dropdown">Оценить место</button>
					</div>
					<div class="col-sm-12">
						<div class="vk_like-wrap335">
							<div id="vk_like_vs335"></div>
						
								<script type="text/javascript">
								VK.Widgets.Like335("vk_like_vs335", {type: "button", height: 24});
								</script>	
						
						</div>
					</div>	
				</div>
				
				
				<div class="row vs991">
						
					<div class="col-sm-12">
						<div class="btn-group mrg-bot15">
							  <button type="button" class="btn btn-danger btn-block dropdown-toggle" 
									data-toggle="dropdown">Лента новостей <span class="caret"></span></button>
							  <ul class="dropdown-menu" role="menu">
									<li><a data-action="sobutiya" onclick="showAction(this);"
											href="javascript: void(0);">События</a></li>
									<li><a data-action="akcii" onclick="showAction(this);"
												href="javascript: void(0);">Акции</a></li>
									<li><a data-action="nowinki" onclick="showAction(this);" 
												href="javascript: void(0);">Новинки</a></li>
							  </ul>
							</div>
					</div>
					
				</div>
				
				<div id="akcii">
					<?$APPLICATION->IncludeComponent("andatr:news.list","akcii",Array(
									"DISPLAY_DATE" => "Y",
									"DISPLAY_NAME" => "Y",
									"DISPLAY_PICTURE" => "Y",
									"DISPLAY_PREVIEW_TEXT" => "Y",
									"AJAX_MODE" => "Y",
									"IBLOCK_TYPE" => "akcii",
									"IBLOCK_ID" => "6",
									"PARENT_ELEMENT_ID" => $arResult["ID"],
									"NEWS_COUNT" => "20",
									"SORT_BY1" => "ACTIVE_FROM",
									"SORT_ORDER1" => "DESC",
									"SORT_BY2" => "SORT",
									"SORT_ORDER2" => "ASC",
									"FILTER_NAME" => "",
									"FIELD_CODE" => Array("ID"),
									"PROPERTY_CODE" => Array("DESCRIPTION"),
									"CHECK_DATES" => "Y",
									"DETAIL_URL" => "",
									"PREVIEW_TRUNCATE_LEN" => "",
									"ACTIVE_DATE_FORMAT" => "d.m.Y",
									"SET_TITLE" => "Y",
									"SET_BROWSER_TITLE" => "Y",
									"SET_META_KEYWORDS" => "Y",
									"SET_META_DESCRIPTION" => "Y",
									"SET_STATUS_404" => "Y",
									"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
									"ADD_SECTIONS_CHAIN" => "Y",
									"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
									"PARENT_SECTION" => "",
									"PARENT_SECTION_CODE" => "",
									"INCLUDE_SUBSECTIONS" => "Y",
									"CACHE_TYPE" => "A",
									"CACHE_TIME" => "3600",
									"CACHE_FILTER" => "Y",
									"CACHE_GROUPS" => "Y",
									"DISPLAY_TOP_PAGER" => "Y",
									"DISPLAY_BOTTOM_PAGER" => "Y",
									"PAGER_TITLE" => "Новости",
									"PAGER_SHOW_ALWAYS" => "Y",
									"PAGER_TEMPLATE" => "",
									"PAGER_DESC_NUMBERING" => "Y",
									"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
									"PAGER_SHOW_ALL" => "Y",
									"AJAX_OPTION_JUMP" => "N",
									"AJAX_OPTION_STYLE" => "Y",
									"AJAX_OPTION_HISTORY" => "N",
									"AJAX_OPTION_ADDITIONAL" => ""
							)
					);?>
				</div>
				
				<div id="sobutiya">
					<?$APPLICATION->IncludeComponent("andatr:news.list","sobutiya",Array(
									"DISPLAY_DATE" => "Y",
									"DISPLAY_NAME" => "Y",
									"DISPLAY_PICTURE" => "Y",
									"DISPLAY_PREVIEW_TEXT" => "Y",
									"AJAX_MODE" => "Y",
									"IBLOCK_TYPE" => "akcii",
									"IBLOCK_ID" => "6",
									"PARENT_ELEMENT_ID" => $arResult["ID"],
									"NEWS_COUNT" => "20",
									"SORT_BY1" => "ACTIVE_FROM",
									"SORT_ORDER1" => "DESC",
									"SORT_BY2" => "SORT",
									"SORT_ORDER2" => "ASC",
									"FILTER_NAME" => "",
									"FIELD_CODE" => Array("ID"),
									"PROPERTY_CODE" => Array("DESCRIPTION"),
									"CHECK_DATES" => "Y",
									"DETAIL_URL" => "",
									"PREVIEW_TRUNCATE_LEN" => "",
									"ACTIVE_DATE_FORMAT" => "d.m.Y",
									"SET_TITLE" => "Y",
									"SET_BROWSER_TITLE" => "Y",
									"SET_META_KEYWORDS" => "Y",
									"SET_META_DESCRIPTION" => "Y",
									"SET_STATUS_404" => "Y",
									"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
									"ADD_SECTIONS_CHAIN" => "Y",
									"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
									"PARENT_SECTION" => "",
									"PARENT_SECTION_CODE" => "",
									"INCLUDE_SUBSECTIONS" => "Y",
									"CACHE_TYPE" => "A",
									"CACHE_TIME" => "3600",
									"CACHE_FILTER" => "Y",
									"CACHE_GROUPS" => "Y",
									"DISPLAY_TOP_PAGER" => "Y",
									"DISPLAY_BOTTOM_PAGER" => "Y",
									"PAGER_TITLE" => "Новости",
									"PAGER_SHOW_ALWAYS" => "Y",
									"PAGER_TEMPLATE" => "",
									"PAGER_DESC_NUMBERING" => "Y",
									"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
									"PAGER_SHOW_ALL" => "Y",
									"AJAX_OPTION_JUMP" => "N",
									"AJAX_OPTION_STYLE" => "Y",
									"AJAX_OPTION_HISTORY" => "N",
									"AJAX_OPTION_ADDITIONAL" => ""
							)
					);?>
				</div>
				
				<div id="novinki">
					<?$APPLICATION->IncludeComponent("andatr:news.list","novinki",Array(
									"DISPLAY_DATE" => "Y",
									"DISPLAY_NAME" => "Y",
									"DISPLAY_PICTURE" => "Y",
									"DISPLAY_PREVIEW_TEXT" => "Y",
									"AJAX_MODE" => "Y",
									"IBLOCK_TYPE" => "akcii",
									"IBLOCK_ID" => "6",
									"PARENT_ELEMENT_ID" => $arResult["ID"],
									"NEWS_COUNT" => "20",
									"SORT_BY1" => "ACTIVE_FROM",
									"SORT_ORDER1" => "DESC",
									"SORT_BY2" => "SORT",
									"SORT_ORDER2" => "ASC",
									"FILTER_NAME" => "",
									"FIELD_CODE" => Array("ID"),
									"PROPERTY_CODE" => Array("DESCRIPTION"),
									"CHECK_DATES" => "Y",
									"DETAIL_URL" => "",
									"PREVIEW_TRUNCATE_LEN" => "",
									"ACTIVE_DATE_FORMAT" => "d.m.Y",
									"SET_TITLE" => "Y",
									"SET_BROWSER_TITLE" => "Y",
									"SET_META_KEYWORDS" => "Y",
									"SET_META_DESCRIPTION" => "Y",
									"SET_STATUS_404" => "Y",
									"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
									"ADD_SECTIONS_CHAIN" => "Y",
									"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
									"PARENT_SECTION" => "",
									"PARENT_SECTION_CODE" => "",
									"INCLUDE_SUBSECTIONS" => "Y",
									"CACHE_TYPE" => "A",
									"CACHE_TIME" => "3600",
									"CACHE_FILTER" => "Y",
									"CACHE_GROUPS" => "Y",
									"DISPLAY_TOP_PAGER" => "Y",
									"DISPLAY_BOTTOM_PAGER" => "Y",
									"PAGER_TITLE" => "Новости",
									"PAGER_SHOW_ALWAYS" => "Y",
									"PAGER_TEMPLATE" => "",
									"PAGER_DESC_NUMBERING" => "Y",
									"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
									"PAGER_SHOW_ALL" => "Y",
									"AJAX_OPTION_JUMP" => "N",
									"AJAX_OPTION_STYLE" => "Y",
									"AJAX_OPTION_HISTORY" => "N",
									"AJAX_OPTION_ADDITIONAL" => ""
							)
					);?>
				</div>
				
			<?if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
			{
				?>
				<div class="news-detail-share">
					<noindex>
					<?
					$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
							"HANDLERS" => $arParams["SHARE_HANDLERS"],
							"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
							"PAGE_TITLE" => $arResult["~NAME"],
							"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
							"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
							"HIDE" => $arParams["SHARE_HIDE"],
						),
						$component,
						array("HIDE_ICONS" => "Y")
					);
					?>
					</noindex>
				</div>
				<?
			}
			?>
		
			<script type="text/javascript">
				function displCont(e){
					var swcase = $(e).attr('data');
					switch(swcase){
						case 'descr':
							if($('#descr').css('display') === 'none')
							{
								var parnt = $(e).parent()[0].nodeName;
								if(parnt !== 'LI')
								{
									$('#descr').css('display', 'block');
									$('#network').css('display', 'none');
									$('#map-mesto').css('display', 'none');
									$('#inter').css('display', 'none');
									$('#menu-list').css('display', 'none');
									
									$('div.bookmark-btn a[data=descr]').attr('class', 'btn btn-primary hd569');
									$('div.bookmark-btn a[data=map]').attr('class', 'btn btn-default hd569');
									$('div.bookmark-btn a[data=menu]').attr('class', 'btn btn-default hd569');
									$('div.bookmark-btn a[data=inter]').attr('class', 'btn btn-default hd569');
								}
								else
								{
									$('#descr').css('display', 'block');
									$('#network').css('display', 'none');
									$('#map-mesto').css('display', 'none');
									$('#inter').css('display', 'none');
									$('#menu-list').css('display', 'none');
									
									$($('a[data=descr]').parent()[1]).addClass('bookmark-active');
									$($('a[data=inter]').parent()[1]).removeClass('bookmark-active');
									$($('a[data=map]').parent()[1]).removeClass('bookmark-active');
									$($('a[data=menu]').parent()[1]).removeClass('bookmark-active');
									$($('a[data=network]').parent()[1]).removeClass('bookmark-active');
									
									$($('a[data=descr]').parent()[2]).addClass('bookmark-active');
									$($('a[data=inter]').parent()[2]).removeClass('bookmark-active');
									$($('a[data=map]').parent()[2]).removeClass('bookmark-active');
									$($('a[data=menu]').parent()[2]).removeClass('bookmark-active');
									$($('a[data=network]').parent()[2]).removeClass('bookmark-active');
									
									$('.dropdown-toggle.335').html('Описание <span class="caret"></span>');
								}
								
							}

							break;
							
						case 'inter':
							if($('#inter').css('display') === 'none')
							{
								var parnt = $(e).parent()[0].nodeName;
								if(parnt !== 'LI')
								{
									$('#inter').css('display', 'block');
									$('#network').css('display', 'none');
									$('#descr').css('display', 'none');
									$('#map-mesto').css('display', 'none');
									$('#menu-list').css('display', 'none');
									
									$('div.bookmark-btn a[data=inter]').attr('class', 'btn btn-primary hd569');
									$('div.bookmark-btn a[data=map]').attr('class', 'btn btn-default hd569');
									$('div.bookmark-btn a[data=descr]').attr('class', 'btn btn-default hd569');
									$('div.bookmark-btn a[data=menu]').attr('class', 'btn btn-default hd569');
								}
								else
								{
									$('#inter').css('display', 'block');
									$('#network').css('display', 'none');
									$('#descr').css('display', 'none');
									$('#map-mesto').css('display', 'none');
									$('#menu-list').css('display', 'none');
									
									$($('a[data=inter]').parent()[1]).addClass('bookmark-active');
									$($('a[data=map]').parent()[1]).removeClass('bookmark-active');
									$($('a[data=descr]').parent()[1]).removeClass('bookmark-active');
									$($('a[data=menu]').parent()[1]).removeClass('bookmark-active');
									$($('a[data=network]').parent()[1]).removeClass('bookmark-active');
									
									$($('a[data=inter]').parent()[2]).addClass('bookmark-active');
									$($('a[data=map]').parent()[2]).removeClass('bookmark-active');
									$($('a[data=descr]').parent()[2]).removeClass('bookmark-active');
									$($('a[data=menu]').parent()[2]).removeClass('bookmark-active');
									$($('a[data=network]').parent()[2]).removeClass('bookmark-active');
									
									$('.dropdown-toggle.335').html('Интерьер <span class="caret"></span>');
								}
							}
							break;
							
						case 'map':
							if($('#map-mesto').css('display') === 'none')
							{
								var parnt = $(e).parent()[0].nodeName;
								if(parnt !== 'LI')
								{
									$('#map-mesto').css('display', 'block');
									$('#network').css('display', 'none');
									$('#descr').css('display', 'none');
									$('#inter').css('display', 'none');
									$('#menu-list').css('display', 'none');
									
									$('div.bookmark-btn a[data=map]').attr('class', 'btn btn-primary hd569');
									$('div.bookmark-btn a[data=descr]').attr('class', 'btn btn-default hd569');
									$('div.bookmark-btn a[data=menu]').attr('class', 'btn btn-default hd569');
									$('div.bookmark-btn a[data=inter]').attr('class', 'btn btn-default hd569');
								}
								else
								{
									$('#map-mesto').css('display', 'block');
									$('#network').css('display', 'none');
									$('#descr').css('display', 'none');
									$('#inter').css('display', 'none');
									$('#menu-list').css('display', 'none');
									
									$($('a[data=map]').parent()[1]).addClass('bookmark-active');
									$($('a[data=inter]').parent()[1]).removeClass('bookmark-active');
									$($('a[data=descr]').parent()[1]).removeClass('bookmark-active');
									$($('a[data=menu]').parent()[1]).removeClass('bookmark-active');
									$($('a[data=network]').parent()[1]).removeClass('bookmark-active');
									
									$($('a[data=map]').parent()[2]).addClass('bookmark-active');
									$($('a[data=inter]').parent()[2]).removeClass('bookmark-active');
									$($('a[data=descr]').parent()[2]).removeClass('bookmark-active');
									$($('a[data=menu]').parent()[2]).removeClass('bookmark-active');
									$($('a[data=network]').parent()[2]).removeClass('bookmark-active');
									
									$('.dropdown-toggle.335').html('Карта <span class="caret"></span>');
								}
								
							}

							break;
							
						case 'menu':
							if($('#menu-list').css('display') === 'none')
							{
								var parnt = $(e).parent()[0].nodeName;
								if(parnt !== 'LI')
								{
									$('#menu-list').css('display', 'block');
									$('#network').css('display', 'none');
									$('#map-mesto').css('display', 'none');
									$('#descr').css('display', 'none');
									$('#inter').css('display', 'none');
									
									$('div.bookmark-btn a[data=menu]').attr('class', 'btn btn-primary hd569');
									$('div.bookmark-btn a[data=map]').attr('class', 'btn btn-default hd569');
									$('div.bookmark-btn a[data=descr]').attr('class', 'btn btn-default hd569');
									$('div.bookmark-btn a[data=inter]').attr('class', 'btn btn-default hd569');
								}
								else
								{
									$('#menu-list').css('display', 'block');
									$('#network').css('display', 'none');
									$('#map-mesto').css('display', 'none');
									$('#descr').css('display', 'none');
									$('#inter').css('display', 'none');
									
									$($('a[data=menu]').parent()[1]).addClass('bookmark-active');
									$($('a[data=map]').parent()[1]).removeClass('bookmark-active');
									$($('a[data=inter]').parent()[1]).removeClass('bookmark-active');
									$($('a[data=descr]').parent()[1]).removeClass('bookmark-active');
									$($('a[data=network]').parent()[1]).removeClass('bookmark-active');
									
									$($('a[data=menu]').parent()[2]).addClass('bookmark-active');
									$($('a[data=map]').parent()[2]).removeClass('bookmark-active');
									$($('a[data=inter]').parent()[2]).removeClass('bookmark-active');
									$($('a[data=descr]').parent()[2]).removeClass('bookmark-active');
									$($('a[data=network]').parent()[2]).removeClass('bookmark-active');
									
									$('.dropdown-toggle.335').html('Меню <span class="caret"></span>');
								}
								
							}
							break;
							
							case 'network':
								if($('#network').css('display') === 'none')
								{
									var parnt = $(e).parent()[0].nodeName;
									if(parnt !== 'LI')
									{
										$('#network').css('display', 'block');
										$('#menu-list').css('display', 'none');
										$('#map-mesto').css('display', 'none');
										$('#descr').css('display', 'none');
										$('#inter').css('display', 'none');
										
										$('div.bookmark-btn a[data=menu]').attr('class', 'btn btn-default hd569');
										$('div.bookmark-btn a[data=map]').attr('class', 'btn btn-default hd569');
										$('div.bookmark-btn a[data=descr]').attr('class', 'btn btn-default hd569');
										$('div.bookmark-btn a[data=inter]').attr('class', 'btn btn-default hd569');
									}
									else
									{
										$('#network').css('display', 'block');
										$('#menu-list').css('display', 'none');
										$('#map-mesto').css('display', 'none');
										$('#descr').css('display', 'none');
										$('#inter').css('display', 'none');
										
										$($('a[data=network]').parent()[1]).addClass('bookmark-active');
										$($('a[data=menu]').parent()[1]).removeClass('bookmark-active');
										$($('a[data=map]').parent()[1]).removeClass('bookmark-active');
										$($('a[data=inter]').parent()[1]).removeClass('bookmark-active');
										$($('a[data=descr]').parent()[1]).removeClass('bookmark-active');
									
										$($('a[data=network]').parent()[2]).addClass('bookmark-active');
										$($('a[data=menu]').parent()[2]).removeClass('bookmark-active');
										$($('a[data=map]').parent()[2]).removeClass('bookmark-active');
										$($('a[data=inter]').parent()[2]).removeClass('bookmark-active');
										$($('a[data=descr]').parent()[2]).removeClass('bookmark-active');
										
										$('.dropdown-toggle.335').html('Сеть <?=$cntNetw?> <span class="caret"></span>');
									}
									
								}
							break;
							
						default:
							console.log('атрибут не найден');
							break;
					}
				}
				
				function showAction(el){
					var parent = $(el).parent()[0].nodeName;

					switch($(el).data('action')){
						case 'sobutiya':
							$('#akcii').css('display', 'none');
							$('#novinki').css('display', 'none');
							$('#sobutiya').css('display', 'block');
							if(parent === 'LI'){
								$('.bookmark-action-active').removeClass('bookmark-action-active');
								$($(el).parent()[0]).addClass('bookmark-action-active');
							}
							break;
						case 'akcii':
							$('#novinki').css('display', 'none');
							$('#sobutiya').css('display', 'none');
							$('#akcii').css('display', 'block');
							if(parent === 'LI'){
								$('.bookmark-action-active').removeClass('bookmark-action-active');
								$($(el).parent()[0]).addClass('bookmark-action-active');
							}
							break;
						case 'nowinki':
							$('#akcii').css('display', 'none');
							$('#sobutiya').css('display', 'none');
							$('#novinki').css('display', 'block');
							if(parent === 'LI'){
								$('.bookmark-action-active').removeClass('bookmark-action-active');
								$($(el).parent()[0]).addClass('bookmark-action-active');
							}
							break;
						default:
							console.log('для ключа data вариантов нет');
							break;
					}
				}
			</script>		
<?endif?>	