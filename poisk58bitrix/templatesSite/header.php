<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <?$APPLICATION->ShowMeta("robots")?>
        <?$APPLICATION->ShowMeta("keywords")?>
        <?$APPLICATION->ShowMeta("description")?>
        <?$APPLICATION->ShowHead();?>
        <title><?$APPLICATION->ShowTitle()?></title>
        <?IncludeTemplateLangFile(__FILE__);?>

	    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.mmenu.min.all.js" type="text/javascript"></script>
	
    <!-- Bootstrap -->
    <link href="<?=SITE_TEMPLATE_PATH?>/template_styles.css" rel="stylesheet">
	

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<script type="text/javascript">
	   $(document).ready(function() {
		  
		  $("#my-menu").mmenu(
		  {slidingSubmenus: false,
			dragOpen: true});
			
			$("#my-rtmenu").mmenu(
		  {slidingSubmenus: false,
		    position: 'right',
			classes: "mm-white",
			dragOpen: true});
			
		  $(".List").css('display', 'block');
		 });
	</script>

  </head>
  <body class="<?$APPLICATION->ShowViewContent('class');?>">
  <article>
	  <div id="my-header" class="mm-fixed-top">
			<a class="menu" href="#my-menu"></a>
				<div class='navigat'>
					<a href="/" class="logo"></a><span class="caption"><a href="/">POISK58</a></span><div class="path btn-danger">
							<?$APPLICATION->ShowTitle()?>
						</div>
				</div>		
			<a class="menu nav-right" href="#my-rtmenu"></a>
		  </div>
	  
		<nav id="my-menu">
			<!--<ul class="List">
				<li class="avtoriz">
					<i class="vk"></i>
					<a href="/">Войти с помощью Вконтакте</a></li>
			   <li class="Selected"><a href="/">Home</a></li>  
			   <li><a href="/about/">About us</a></li>
			   <li>
					<a href="/about/">Submenu</a>
					 <ul>
						<li><a href="/about/history/">History</a></li>
						<li><a href="/about/team/">The team</a></li>
						<li><a href="/about/address/">Our address</a></li>
					 </ul>
			   </li>
			   <li><a href="/contact/">Contact</a></li>
			   <li class="Label"></li> 
			   <li><a href="/contact/">Aber</a></li>
			   <li><a href="/contact/">Zolder</a></li>
			   <li><a href="/contact/">Soldaten</a></li>
			   <li><a href="/contact/">Rubem</a></li>
			   <li><a href="/contact/">Kuren</a></li>
			   <li class="Label"></li> 
			</ul>-->
			<?$APPLICATION->IncludeComponent("bitrix:menu", "treePoisk58", array(
				"ROOT_MENU_TYPE" => "left",
				"MENU_CACHE_TYPE" => "N",
				"MENU_CACHE_TIME" => "3600",
				"MENU_CACHE_USE_GROUPS" => "Y",
				"MENU_CACHE_GET_VARS" => array(
				),
				"MAX_LEVEL" => "2",
				"CHILD_MENU_TYPE" => "left",
				"USE_EXT" => "Y",
				"DELAY" => "N",
				"ALLOW_MULTI_SELECT" => "N"
				),
				false
			);?>
		</nav>	
		<?
			$dir = $APPLICATION->GetCurDir();
			preg_match('|\/catalog\/([^\/]+)\/([^\/]+)?\/?|', $dir, $math);
		?>
		<nav id="my-rtmenu">
			<?if($math[1] === "akcii" || $math[1] === "sobutiya" || $math[1] === "nowinki"):?>
				<ul class="List">
					 <li class="Selected">Первый</li>
					 <li class="Label">Второй</li>   
					 <li>Третий</li>
					 <li>
						<a href="/about/">Submenu</a>
						 <ul>
							<li><a href="/about/history/">History</a></li>
							<li><a href="/about/team/">The team</a></li>
							<li><a href="/about/address/">Our address</a></li>
						 </ul>
					 </li>
					 <li><a href="/contact/">Contact</a></li>
				</ul>
			<?endif?>
			
			<?if($math[1] !== "akcii" && $math[1] !== "sobutiya" && $math[1] !== "nowinki"):?>
				<div>
						<div class="List wrap-right-menu">
							<div class="mrg-bot20">
								<a href="/catalog/<?=(empty($math[1])?"":$math[1]."/")?>
										<?=(empty($math[2])?"":$math[2]."/")?>"
										class="btn btn-default btn-block
										<?if(empty($_GET['sort'])):?>active<?endif?>"
										onclick="sortActiveReset(this);">
										рекомендуем
								</a>
								<a href="/catalog/<?=(empty($math[1])?"":$math[1]."/")?>
										<?=(empty($math[2])?"":$math[2]."/")?>?sort=created_date"
										class="btn btn-default btn-block 
										<?if($_GET['sort']==='created_date'):?>active<?endif?>"
										onclick="sortActiveReset(this);">
										новые
								</a>
								<a href="/catalog/<?=(empty($math[1])?"":$math[1]."/")?>
										<?=(empty($math[2])?"":$math[2]."/")?>?sort=show_counter"
										class="btn btn-default btn-block
										<?if($_GET['sort']==='show_counter'):?>active<?endif?>"
										onclick="sortActiveReset(this);">
										популярные
								</a>	
								<a href="/catalog/<?=(empty($math[1])?"":$math[1]."/")?>
										<?=(empty($math[2])?"":$math[2]."/")?>?sort=вразработке"
										class="btn btn-default btn-block
										<?if($_GET['sort']==='вразработке'):?>active<?endif?>"
										onclick="sortActiveReset(this);">
										любимые места
								</a>
							</div>	
							
							<div>
								<?$APPLICATION->IncludeComponent (
									"bitrix:catalog.smart.filter",
											"poisk58",
											Array(
													"IBLOCK_TYPE" => "mesta",
													"IBLOCK_ID" => "4",
													"SECTION_ID" => $_REQUEST["SECTION_ID"],
													"FILTER_NAME" => "arrFilter",
													"PRICE_CODE" => array("BASE"),
													"CACHE_TYPE" => "A",
													"CACHE_TIME" => "36000000",
													"CACHE_GROUPS" => "Y",
													"SAVE_IN_SESSION" => "Y",
													"INSTANT_RELOAD" => "Y",
													"XML_EXPORT" => "Y",
													"SECTION_TITLE" => "NAME",
													"SECTION_DESCRIPTION" => "DESCRIPTION",
													"HIDE_NOT_AVAILABLE" => "N"
											)
									);?>
							</div>
						</div>	
				</div>
			<?endif?>
		</nav>	
		<script>
			function sortActiveReset(el){
				$('.active').toggleClass('active');
				$(el).toggleClass('active');
			}
		</script>
		<div class="container margin-topcnt">
<?$APPLICATION->ShowPanel();?>