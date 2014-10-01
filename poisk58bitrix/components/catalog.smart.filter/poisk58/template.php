<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?/*Формируем путь для фильтра */
	if(!function_exists('formAction')){
		function formAction(&$path){
			define('SIMB', '/');
			$len = strlen($path);
			$cnt = 0;
			
			for($i = 0; $i < $len; $i++){
				if($cnt <= 3){	
					if($path[$i] === SIMB){
						++$cnt;
					}	
				}else{
					$path[$i] = "\n";
				}	
			}

		}
	}
	
	formAction($arResult["FORM_ACTION"]);
?>

<?/*Показывать ли кнопку сохранить*/
	if(!function_exists('showBut')){
		function showBut($ar){
			foreach($ar as $arItem){
				foreach($arItem["VALUES"] as $val => $ar){
					if(!empty($ar["CHECKED"])){
						return true;
					}
				}
			}
			return false;
		}
	}
?>

<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?=$arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
	<?foreach($arResult["HIDDEN"] as $arItem):?>
		<input
			type="hidden"
			name="<?echo $arItem["CONTROL_NAME"]?>"
			id="<?echo $arItem["CONTROL_ID"]?>"
			value="<?echo $arItem["HTML_VALUE"]?>"
		/>
	<?endforeach;?>

	<?if(showBut($arResult["ITEMS"])):?>
		<div class="mrg-bot20">
			<input class="btn btn-primary btn-block" type="submit" id="del_filter" name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>" />
		</div>
	<?endif?>	
	
	<div class="filtren btn-group" data-toggle="buttons-checkbox">
		
		<div>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?if($arItem["PROPERTY_TYPE"] == "N" || isset($arItem["PRICE"])):?>
			<span><?=$arItem["NAME"]?></span>
					<?
						//$arItem["VALUES"]["MIN"]["VALUE"];
						//$arItem["VALUES"]["MAX"]["VALUE"];
					?>
					<div class="lvl2" style="border-bottom: 1px solid #ccc; padding-left:30px">
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td>
									<span class="min-price"><?echo GetMessage("CT_BCSF_FILTER_FROM")?></span>
								</td>
								<td>
									<span class="max-price"><?echo GetMessage("CT_BCSF_FILTER_TO")?></span>
								</td>
							</tr>
							<tr>
								<td><input
									class="min-price"
									type="text"
									name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
									id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
									value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
									size="5"
									<!--onkeyup="smartFilter.keyup(this)"
								/>--></td>
								<td><input
									class="max-price"
									type="text"
									name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
									id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
									value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
									size="5"
									<!--onkeyup="smartFilter.keyup(this)"
								/>--></td>
							</tr>
						</table>
					</div>
				
		
			<?elseif(!empty($arItem["VALUES"])):;?>
			
			<div>
				<?if(!strpos($arItem["CODE"], "FILTER")):?>
				<!--<div>
						<span><?/*=$arItem["NAME"]*/?></span>
					</div>-->
				<?endif?>

				<div class="mrg-bot20">

					<?$cnt = 0;?>
						<?foreach($arItem["VALUES"] as $val => $ar):?>
                                            
							<?if($cnt == 3):?>
								<button  type="button" class="btn btn-default" data-toggle="collapse" data-target="#<?=$ar["CONTROL_NAME"]?>">
									...
									</button>
							</div>
								<div  id="<?=$ar["CONTROL_NAME"]?>" class="collapse">
									<div style="padding-left: 1px;">
							<?endif?>
									<?if(!empty($ar["VALUE"])):?>
										<?if(!strcasecmp($arItem["NAME"], 'Система оплаты')):?>
											<?$cls = 'btn-block mrg-bot10';
												$act = $ar["CHECKED"]?'active':'';
												$chek = $ar["CHECKED"]?'checked':'';
												$str .= '<input '.$chek.' class="btn" type="checkbox" style="display:none;" name="'.$ar["CONTROL_NAME"].'" value="'.$ar["HTML_VALUE"].'" id="'.$ar["CONTROL_ID"].'"/> <label class="btn btn-default indent-bottom5 indent-right1'.$act.'btn-block mrg-bot10 '.$act.'"	style="display:inline-block;" for="'.$ar["CONTROL_ID"].'" onclick="chek(this);">'.$ar["VALUE"].'</label>';
											?>	
										<?else:?>
											<input 
												class="btn"
												type="checkbox" style="display:none;"
												name="<?echo $ar["CONTROL_NAME"]?>"
												value="<?echo $ar["HTML_VALUE"]?>"
												id="<?echo $ar["CONTROL_ID"]?>"
												<?=$ar["CHECKED"]?'checked':''?>/>
												<label class="btn btn-default indent-bottom5 indent-right1 
																			<?=$ar["CHECKED"]?'active':''?>
																	<?if(!strcasecmp($arItem["NAME"], 'Система оплаты')):?>
																			btn-block mrg-bot10
																	<?endif?> 
																"	
																style="display:inline-block;" for="<?echo $ar["CONTROL_ID"]?>"
																onclick='chek(this);'>
													<?echo $ar["VALUE"];?>
												</label>
										<?endif?>		
										<?$cnt++;?>
									<?endif?>		
						<?endforeach;?>
						
						<?if($cnt == 3):?>
									</div>
							 </div> 
						<?endif?>
				</div>	
					<i class="clearfix"></i>
			</div>	
			<?endif;?>
		<?endforeach;?>
		
		<?=$str?>
		</div>

	<!--	<div class="modef" id="modef" <?/*if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';*/?>>
			<?/*echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));*/?>
			<a href="<?/*echo $arResult["FILTER_URL"]?>" class="showchild"><?echo GetMessage("CT_BCSF_FILTER_SHOW")*/?></a>-->
			<!--<span class="ecke"></span>
		</div>-->
	</div>
	<div class="mrg-top10">
			<input class="btn btn-primary btn-block" style="margin-right: 38px" type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" />
	</div>	
</form>
<script>
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>');
</script>
<script>
	function chek(el){
		var chek = $(el).prev()[0].id;
		if($("#"+chek).prop("checked")){
			$("#"+chek).prop("checked", false);
		}else{
			$("#"+chek).prop("checked", true);
		}
	}
</script>