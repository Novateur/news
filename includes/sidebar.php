				<div class="panel panel-danger">
					<div class="panel-heading">					
						<h4><i class="glyphicon glyphicon-tags"></i> &nbsp;Categories</h4>
					</div>
					<div class="panel-body">
						<ul class="list-group" style='font-size:13px'>
							<?php
								$category = get_categories_home();
								foreach($category as $cat)
								{
									echo "<li class='list-group-item'><a href='category.php?category={$cat}&page=1'>{$cat}</a><span class='pull-right'><button type='button' onclick=\"$('#{$cat}').slideToggle();\" class='btn btn-default btn-sm' style='border:none'><i class='fa fa-caret-down'></i></button></span>
										<div id='{$cat}'>";
												get_latest_top_stories($cat);
										echo "</div>
									</li>";
								}
							?>
						</ul>
					</div>					
					<div class="panel-heading">
						<h4><i class="glyphicon glyphicon-hdd"></i> Our archive</h4>
					</div>
					<div class="panel-body">

						<ul class="list-group">
							<li class="list-group-item"><a href="old_news.php?fetch_old_news=yesterday&page=1">Yesterday</a></li>
							<li class="list-group-item">Fetch by days <span class="pull-right"><button type="button" style="border:none" onclick="$('#days_form').slideToggle()"><i class="glyphicon glyphicon-chevron-down"></i></button></span>
								<form method="get" action="old_news.php?page=1" style="display:none" id="days_form">
									<input type="text" name="days_ago" id="days_ago" class="form-control input-sm" placeholder="number of days to go back to"/><br/>
									<input type="hidden" name="page" id="page" class="form-control input-sm" value="1"/>
									<button type="submit" class="btn btn-default btn-sm" style="border:1px solid #e68a00">GO</button>
								</form>
							</li>
							<li class="list-group-item">Fetch by weeks <span class="pull-right"><button type="button" style="border:none" onclick="$('#weeks_form').slideToggle()"><i class="glyphicon glyphicon-chevron-down"></i></button></span>
								<form method="get" action="old_news.php?page=1" style="display:none" id="weeks_form">
									<input type="text" name="weeks_ago" id="weeks_ago" class="form-control input-sm" placeholder="number of weeks to go back to"/><br/>
									<input type="hidden" name="page" id="page" class="form-control input-sm" value="1"/>
									<button type="submit" class="btn btn-default btn-sm" style="border:1px solid #e68a00;margin-top:-5px">GO</button>
								</form>
							</li>
							<li class="list-group-item">Fetch by months <span class="pull-right"><button type="button" style="border:none" onclick="$('#months_form').slideToggle()"><i class="glyphicon glyphicon-chevron-down"></i></button></span>
								<form method="get" action="old_news.php?page=1" style="display:none" id="months_form">
									<input type="text" name="months_ago" id="months_ago" class="form-control input-sm" placeholder="number of months to go back to"/><br/>
									<input type="hidden" name="page" id="page" class="form-control input-sm" value="1"/>
									<button type="submit" class="btn btn-default btn-sm" style="border:1px solid #e68a00">GO</button>
								</form>
							</li>
							<li class="list-group-item">Fetch by years <span class="pull-right"><button type="button" style="border:none" onclick="$('#years_form').slideToggle()"><i class="glyphicon glyphicon-chevron-down"></i></button></span>
								<form method="get" action="old_news.php?page=1" style="display:none" id="years_form">
									<input type="text" name="years_ago" id="years_ago" class="form-control input-sm" placeholder="number of years to go back to"/><br/>
									<input type="hidden" name="page" id="page" class="form-control input-sm" value="1"/>
									<button type="submit" class="btn btn-default btn-sm" style="border:1px solid #e68a00">GO</button>
								</form>
							</li>
						</ul>
					</div>					
					<div class="panel-heading">
						<h4><i class="fa fa-bar-chart"></i> Popular</h4>
					</div>
					<div class="panel-body">

						<ul style='font-size:13px'>
							<?php
								get_popular();
							?>
						</ul>
					</div>
				</div>