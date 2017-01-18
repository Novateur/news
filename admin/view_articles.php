
	<?php
		include_once("includes/header_menu.php");
	?>
		<div class="container">
			<div class="row">
				<button class="btn btn-warning btn-sm pull-right" onclick="show_sidebar()" id="show_menu" style="display:block">Show menu</button>
			</div>
			<div class="row"><br/>
				<!--<div class="col-md-1">
				</div>-->
				<div class="col-md-12">
					<h2><a href="#" onclick="window.history.back()" style="color:#000"><i class="fa fa-arrow-left"></i></a> View Articles</h2>
				</div>				
				<div class="col-md-12">
					<span class="pull-right">Order by category : 
						<select class="form-control" id="category" onchange="fetch_by_cat(this.value)">
							<?php
								get_categories();
							?>
						</select><br/>
					</span>					
					<span class="pull-right">Mode of arrangement : 
						<select class="form-control" id="arrange" onchange="arrange(this.value)">
							<option value="ascending">Ascending</option>
							<option value="descending">Descending</option>
						</select><br/> 
					</span>
				</div>				
				<div class="col-md-12">

					<div id="paste_response"></div>
					<div id="paste_articles">
					
					</div>
				</div>				
				<!--<div class="col-md-1">
				</div>-->
			</div>

		</div>

		<div>
			<!-- Display how fast the page was rendered. -->
		</div>
			<div id="delete_multi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog" style="max-height:90px;margin-top:150px">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<p class="modal-title" id="myModalLabel"style="font-size:13px"><h4><i class="glyphicon glyphicon-trash"></i> Confirm</h4></p>
						</div>
						<div class="modal-body" style='font-size:14px'>
							Are you sure you want to perform a multiple delete task,once you proceed with this action there is no going back
						</div>
						<div class="modal-footer">
							<button class="btn btn-default btn-rounded" data-dismiss="modal" aria-hidden="true">Cancel</button>
							<span id='paste_multi_proceed_btn'></span>
							<!--<button class="btn btn-danger" id="cont_del_multi_btn" onclick="cont_del_multi(this.value)">Proceed</button>-->
						</div>
					</div>
				</div>
			</div>
		  	<div id="delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog" style="width:400px;margin-top:150px">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<p class="modal-title" id="myModalLabel"style="font-size:13px"><h4><i class="glyphicon glyphicon-trash"></i> Delete</h4></p>
						</div>
						<div class="modal-body" style='font-size:14px'>
							Do you really want to delete this article ?
						</div>
						<div class="modal-footer">
							<button class="btn btn-default btn-rounded" data-dismiss="modal" aria-hidden="true">Cancel</button>
							<span id="proceed_btn"></span>
						</div>
					</div>
				</div>
			</div>		  	
			<div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog" style="margin-top:80px">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<p class="modal-title" id="myModalLabel"style="font-size:13px"><h4><i class="glyphicon glyphicon-pencil"></i> Edit</h4></p>
						</div>
						<div class="modal-body" style='font-size:14px'>
							<form id="edit_article_form">
								<div id="paste_edit_form">
								</div>
								
						</div>
						<div class="modal-footer">
							<button class="btn btn-danger btn-rounded" data-dismiss="modal" aria-hidden="true">Close</button>
							<span id="proceed_btn"><button type='submit' class='btn btn-default' name='add' id='add' style='border:1px solid #e68a00'>Update</button></span>
						</div>
						</form>
					</div>
				</div>
			</div>
	


	<script src="../js/jquery-2.1.3.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
			fetch_articles();
		})
		function hide_sidebar()
		{
			$('#sidebar').hide('fast');
			$('#show_menu').show('fast');
			$('#logout').show('fast');
		}		
		function show_sidebar()
		{
			$('#sidebar').show('fast');
			$('#show_menu').hide('fast');
			$('#logout').hide('fast');
		}

		function fetch_articles()
		{
			$.get("handler/fetch_articles.php?page=1",function(response){
				$('#paste_articles').html(response);
				$('#arrange').val("ascending");
			})
		}		
		function paginate(page)
		{
			if($('#category').val()=="")
			{
				$.get("handler/fetch_articles.php?page="+page,function(response){
					$('#paste_articles').html(response);
				})
			}
			else
			{
				var category = $('#category').val();
				$.post("handler/fetch_articles_by_cat.php?page="+page,{category:category},function(response){
					$('#paste_articles').html(response);
				})
			}
		}		
		function paginate_desc(page)
		{
			if($('#category').val()=="")
			{
				$.get("handler/fetch_articles_desc.php?page="+page,function(response){
					$('#paste_articles').html(response);
				})
			}
			else
			{
				var category = $('#category').val();
				$.post("handler/fetch_articles_by_cat_desc.php?page="+page,{category:category},function(response){
					$('#paste_articles').html(response);
				})
			}
		}
		function delete_art(id,page)
		{
			$('#delete').modal('show');
			$('#proceed_btn').html("<button type='button' class='btn btn-danger' onclick=\"cont_del_art("+id+","+page+")\">Ok</button>");
		}
		function cont_del_art(id,page)
		{
			$.post("handler/delete_article.php",{id:id},function(response){
				if(response=="deleted")
				{
					$('#delete').modal('hide');
					if($('#arrange').val()=="ascending")
					{
						paginate(page);
					}
					else
					{
						paginate_desc(page);
					}
					$('#paste_response').html("<div class='alert alert-success' style='font-size:13px'><button type='button' class='close' data-dismiss='alert'>&times;</button><h4><i class='glyphicon glyphicon-check'></i> Success</h4>Article has been deleted successfully</div>").slideDown().delay(8000).slideUp();
				}
				else
				{
					$('#delete').modal('hide');
					$('#paste_response').html("<div class='alert alert-danger' style='font-size:13px'><button type='button' class='close' data-dismiss='alert'>&times;</button><h4><i class='glyphicon glyphicon-notification'></i> Error</h4>"+response+"</div>").slideDown().delay(8000).slideUp();
				}
			})
		}
		function edit_article(id,page)
		{
			$.post("handler/edit_article.php",{id:id,page:page},function(response){
				$('#paste_edit_form').html(response);
				$('#edit').modal('show');
			})
		}
		$('#edit_article_form').submit(function(e){
			e.preventDefault();
			var title,content,page;
			title = $('#title').val();
			content = $('#content').val();
			page = $('#page').val();
			
			if(title=="" || content=="")
			{
				if(title=="")
				{
					document.getElementById("title").style.border="1px solid red";
				}
				if(content=="")
				{
					document.getElementById("content").style.border="1px solid red";
				}
			}
			else
			{
				$.ajax({
					url:"handler/update_article.php",
					type:"POST",
					data: new FormData(this),
					cache:false,
					contentType:false,
					processData:false,
					success:function(data)
					{
						if(data=="updated")
						{
							
							$('#edit').modal('hide');
							if($('#arrange').val()=="ascending")
							{
								paginate(page);
								
							}
							else
							{
								paginate_desc(page);
								
							}
							$('#paste_response').html("<div class='alert alert-success' style='font-size:13px'><button type='button' class='close' data-dismiss='alert'>&times;</button><h4><i class='glyphicon glyphicon-check'></i> Success</h4>Article updated successfully</div>").slideDown().delay(8000).slideUp();
						}
						else
						{
							$('#edit').modal('hide');
							$('#paste_response').html("<div class='alert alert-danger' style='font-size:13px'><button type='button' class='close' data-dismiss='alert'>&times;</button><h4><i class='glyphicon glyphicon-notification'></i> Error</h4>"+data+"</div>").slideDown().delay(8000).slideUp();
						}
					}

				})
			}
		})
		function verify_check(name)
		{
			var favorite=[];
			$.each($("input[name='articles[]']:checked"),function(){
				favorite.push($(this).val());
			});
			if(favorite.length>0)
			{
				//alert("my favorite sports are:"+favorite.join(","));
				$('#btn').show('fast');
				$('#cancel').show('fast');
			}
			else
			{
				$('#btn').hide('fast');
				$('#cancel').hide('fast');
			}
		}
		function cancel_del()
		{
			$('input:checkbox').removeAttr('checked');
			$('#btn').hide('fast');
			$('#cancel').hide('fast');
		}
		function del_multi(page)
	{
		$('#paste_multi_proceed_btn').html("<button class='btn btn-danger btn-rounded' id='proceed_del' onclick=\"cont_del_multi("+page+")\">Proceed</button>");
		$('#delete_multi').modal('show');
	}	
	function cont_del_multi(page)
	{
		$('#delete_multi').modal('hide');
		$.ajax
			({
				url:"handler/multi_del_articles.php",
				type:"POST",
				data:$('#ma_multi_del').serialize(),
				success:function(response)
				{
					if(response=="deleted")
					{
						if($('#arrange').val()=="ascending")
						{
							paginate(page);
						}
						else
						{
							paginate_desc(page);
						}
						$('#paste_response').html("<div class='alert alert-success' style='font-size:13px'><button type='button' class='close' data-dismiss='alert'>&times;</button><h4><i class='glyphicon glyphicon-check'></i> Success</h4>Articles deleted successfully</div>").slideDown().delay(8000).slideUp();
					}
					else
					{
						$('#paste_response').html("<div class='alert alert-success' style='font-size:13px'><button type='button' class='close' data-dismiss='alert'>&times;</button><h4><i class='glyphicon glyphicon-check'></i>"+response+"</div>").slideDown().delay(8000).slideUp();
					}
				},
				error:function(error)
				{
					alert(error);
				}
			});
	}
	function fetch_articles_desc()
	{
		$.get("handler/fetch_articles_desc.php?page=1",function(response){
			$('#paste_articles').html(response);
			
		})
	}
	function mark_all()
	{
		$('.articles').prop('checked',true);
		$('#btn').show('fast');
		$('#cancel').show('fast');
	}
	function arrange(val)
	{
		if(val=="ascending")
		{
			if($('#category').val()=="")
			{
				fetch_articles();
			}
			else
			{
				var category = $('#category').val();
				fetch_by_cat(category);
			}
		}
		else
		{
			if($('#category').val()=="")
			{
				fetch_articles_desc();
			}
			else
			{
				var category = $('#category').val();
				$.post("handler/fetch_articles_by_cat_desc.php?page=1",{category:category},function(response){
					$('#paste_articles').html(response);
					
				})
			}
		}
	}
	function fetch_by_cat(category)
	{	
		if(category!="")
		{
			$.post("handler/fetch_articles_by_cat.php?page=1",{category:category},function(response){
				$('#paste_articles').html(response);
				$('#arrange').val("ascending");
			})
		}
		else
		{
			fetch_articles();
		}
	}
	</script>
</body>
</html>
