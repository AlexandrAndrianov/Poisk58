<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
          <noscript>
			<style>
				.es-carousel ul{
					display:block;
				}
			</style>
		</noscript>
		<?if($_GET['key'] != 'fotoload'):?>
			<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">
					<div class="rg-image-wrapper">
						{{if itemsCount > 1}}                                    
							<div class="rg-image-nav">
								<span id="cntfoto" class="cntfoto">1/10</span>
								<a id='prev' href="#" class="rg-image-nav-prev"><</a>
								<a id='next' href="#" class="rg-image-nav-next">></a>
							</div>
						{{/if}}
						<div class="rg-image"></div>
						<div class="rg-loading"></div>
						<div class="rg-caption-wrapper">
							<div class="rg-caption text_white" style="display:none;">
								<p></p>
							</div>
						</div>
					</div>
			</script>
		<?endif?>						
			<div id="fotogalery">
					<?
							// получим массив групп текущего пользователя
							global $USER;
							$arGroups = $USER->GetUserGroupArray();
					?>
                    <p class="sub"> 
						<?if(in_array(6, $arGroups) | in_array(1, $arGroups)):?>
										<a data-toggle="collapse" href="#fotoadd">Добавить фото</a>
						<?endif?>
									<a href="#" style="visibility: hidden;">dummy</a>
					</p>
						
						<?if(in_array(6, $arGroups) | in_array(1, $arGroups)):?>
								  <div id="fotoadd" class="collapse">
								<?$APPLICATION->IncludeComponent(
								"andatr:photogalleryLink.upload",
								"",
								Array(
									"IBLOCK_TYPE" => "mesta",
									"IBLOCK_ID" => "4",
									"ELEMENT_ID" =>$arParams['ELEMENT_ID'],
									"MAXSIMB" => $arParams['MAXSIMB'],
									"MAXFOTO" => $arParams['MAXFOTO'],
									"PROPERTY_CODE" => $arParams['PROPERTY_CODE']
								)
							);?> 
										  
								  </div>
						<?endif?>
							   
				<!-- <h1 class="text_white">Favourite places in Penza<span>Flirt fotogalleria</span></h1>-->
				<div id="rg-gallery" class="rg-gallery">
					<div class= "centerWrap">
						<div class="rg-thumbs">
							<!-- Elastislide Carousel Thumbnail Viewer -->
							<div class="es-carousel-wrapper">
								<div class="es-nav">
									<span class="es-nav-prev">Previous</span>
									<span class="es-nav-next">Next</span>
								</div>
								<div  class="es-carousel">
									<ul>
										<?
											$VALUES = array();
											$res = CIBlockElement::GetProperty($arParams['IBLOCK_ID'], $arParams['ELEMENT_ID'], "sort", "asc", array("CODE" => $arParams['PROPERTY_CODE']));
										?>
										<?$count = 1;?>
										<?while ($ob = $res->GetNext()):?>
											<?
												$VALUES = explode('|',$ob['VALUE']);
											?>
											<li>
												<a href="#">
													<img count="<?=$count?>"src="<?if(!empty($VALUES[0])):?><?=$VALUES[0]?><?else:?><?=$componentPath?>/images/vip.png<?endif?>" data-large="<?if(!empty($VALUES[0])):?><?=$VALUES[0]?><?else:?><?=$componentPath?>/images/vip.png<?endif?>" alt="<?=$VALUES[1]?>" data-description="<?=$VALUES[1]?>" style="width: 200px;"/>
												</a>
											</li>	
											<?++$count;?>
										<?endwhile?>
									</ul>
								</div>
							</div>
							<!-- End Elastislide Carousel Thumbnail Viewer -->
						</div><!-- rg-thumbs -->
					</div>	
				</div><!-- rg-gallery -->
				
			</div><!-- fotogalery -->
<!--для длинных фото, прокрутка-->			
<?if($_GET['key'] != 'fotoload'):?>
		<script type="text/javascript" src="<?=$componentPath?>/ResponsiveImageGallery/js/jquery.tmpl.min.js"></script>

		<script type="text/javascript" src="<?=$componentPath?>/ResponsiveImageGallery/js/jquery.elastislide.js"></script>
		<script type="text/javascript" src="<?=$componentPath?>/ResponsiveImageGallery/js/gallery.js"></script>
<?endif?>		