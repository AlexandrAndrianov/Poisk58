<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>


<?
	if(!function_exists('translit'))
	{
		$path = $_SERVER["DOCUMENT_ROOT"].$this->GetFolder();
		require $path.'/translit.php';
	}
	
?>
		<div id="fotogaleryList">
			<?$cntItem = count($arResult); 
				for($i = 1; $i <= $cntItem; $i++):?>
					<?foreach($arResult[$i] as $title => $list):?>
						<a class="menu-list menu-list-title" href="javascript:void(0);" 
							data-toggle="collapse" 
							data-target="#<?=translit($title);?>" onclick="toglDwUp(this);">
							<?=$title?>
							<i></i>
						</a>

						<div id="<?=translit($title);?>" class="collapse ">
							<?foreach($list as $ar => $elem ):?>
							
									<noscript>
										<style>
											.es-carousel ul{
												display:block;
											}
										</style>
									</noscript>
									
									<script id="<?=translit($title).translit($ar);?>_img-wrapper-tmpl"
										type="text/x-jquery-tmpl">
												<div class="rg-image-wrapper nopadding">
													{{if itemsCount > 1}}                                    
														<div class="rg-image-nav">
															<span id="<?=translit($title).translit($ar);?>_cntfoto" 
																class="cntfoto"></span>
															<a id='prev' href="#" class="rg-image-nav-prev">Previous Image</a>
															<a id='next' href="#" class="rg-image-nav-next">Next Image</a>
														</div>
													{{/if}}
													<div id="<?=translit($title).translit($ar);?>_rg_image"
														class="rg-image"></div>
													<div class="rg-loading"></div>
													<div class="rg-caption-wrapper">
														<div class="rg-caption text_white" style="display:none;">
															<p class="rg-descr"></p>
														</div>
													</div>
												</div>	
									</script>	
							
								<a id="<?=translit($title).translit($ar);?>_title" 
									class="menu-list menu-list-inside" href="javascript:void(0);" 
									data-toggle="collapse" 
									data-target="#<?=translit($title).translit($ar);?>" onclick="toglDwUp(this);">
									<?=$ar?>
									<i id="<?=translit($title).translit($ar);?>_marker"></i>
								</a>
							
								<div id="<?=translit($title).translit($ar);?>" class="collapse ">
									<div id="<?=translit($title).translit($ar);?>_galleryList" class="rg-gallery">
										<table class="mnlst-table">
												<col width="8%">
												<col width="80%">
												<col width="12%">
												<?
													$cntEl = 1;
													while(!empty($elem[$cntEl])):?>
													<?
														preg_match('|(.+)\((.+)?\)(.+$)|', $elem[$cntEl], $mat)
													?>	
															<tr class="mnlst-table-row">
															 <td class="mnlst-cntr">
																<i  data-large="<?=$elem['F_'.$cntEl]?>"
																	data-description="<?=$mat[1]?>"
																	data-count ="<?=$cntEl?>"
																	class="mnlstel-ico glyphicon glyphicon-camera"></i>
															 </td>
															 <td class="mnlst-descr">
																<?=$mat[1]?><br/>
																<span style="color:#ccc;"><?=$mat[2]?></span>
															 </td>
															 <td>
																<?=$mat[3]?>
															 </td>
															</tr>
												<?$cntEl++;
													endwhile?>		
										</table>
										<script type="text/javascript" src="<?=$componentPath?>/ResponsiveImageGallery/js/jquery.tmpl.min.js"></script>
										<script type="text/javascript" src="<?=$componentPath?>/ResponsiveImageGallery/js/jquery.elastislide.js"></script>
										<script>
											galeryLoad('<?=translit($title).translit($ar);?>', true);
										</script>
									</div><!-- rg-gallery -->
								</div>
							<?endforeach?>	
						</div>
					<?endforeach?>
				<?endfor?>
		</div><!-- fotogalery --> 