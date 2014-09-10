<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	<?global $USER;
		if($USER->IsAdmin()):?>
			<div>
				
				<a href="javascript: void(0);" data-toggle="collapse" data-target="#listAdd">
				  Добавить список
				</a>
				<div id="listAdd" class="collapse">
					<input id="titlelist" class="form-control" placeholder="заголовок списка"/>
					
					<div id ="listElem">
						<div class="col-md-7">
							<input id="text_0" name="text" class="form-control" placeholder="элемент списка">
						</div>	
						
						<div class="col-md-4">						
							<input id="foto_0"  name="foto"  class="form-control"
								placeholder="ссылка на фото"/>
						</div>
						
						<div class="col-md-1">						
							<input onclick="elemAdd(this);" type="button"
								id="addelem_0" class="btn btn-primary pull-right" 
												name="addelem_0" value="+"/>
						</div>						
					</div>
					
					<input onclick="saveList();" type="button" value="сохранить" 
						class="btn btn-primary"/>
				</div>
				
			</div>
		<?endif?>		
	
<?echo "Шаблон подключен"?>