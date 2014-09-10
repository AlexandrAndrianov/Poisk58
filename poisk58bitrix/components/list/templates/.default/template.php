<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<?
	if(!function_exists('translit'))
	{
		$path = $_SERVER["DOCUMENT_ROOT"].$this->GetFolder();
		require $path.'/translit.php';
	}
	
?>

	<?$cntItem = count($arResult); 
		for($i = 1; $i <= $cntItem; $i++):?>
			<?foreach($arResult[$i] as $title => $list):?>
				<a href="javascript:void(0);" data-toggle="collapse" data-target="#<?=translit($title);?>">
					<?=$title?>
				</a>

				<div id="<?=translit($title);?>" class="collapse ">
					<?foreach($list as $ar => $elem ):?>
						<a href="javascript:void(0);" data-toggle="collapse" data-target="#<?=translit($title).translit($ar);?>">
							<?=$ar?>
						</a>

						<div id="<?=translit($title).translit($ar);?>" class="collapse ">
							<?
								$cntEl = count($elem);
								for($e = 1; $e <= $cntEl; $e++):?>
									<p><?=$elem[$e]?></p>
							<?endfor?>
						</div>
					<?endforeach?>	
				</div>
			<?endforeach?>
		<?endfor?>
	