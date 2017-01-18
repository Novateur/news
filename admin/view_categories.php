	<?php
		include_once("includes/header_menu.php");
	?>
		<div class="container">
			<div class="row">
				<button class="btn btn-warning btn-sm pull-right" onclick="show_sidebar()" id="show_menu" style="display:block">Show menu</button>
			</div>
			<div class="row"><br/>
				<div class="col-md-1">
				</div>				
				<div class="col-md-10">
					<h2><a href="#" onclick="window.history.back()" style="color:#000"><i class="fa fa-arrow-left"></i></a> View Categories</h2>
					<div id="paste_response"></div>
					<div id="paste_categories">
					
					</div>
				</div>				
				<div class="col-md-1">
				</div>
			</div>

		</div>

		<div>
			<!-- Display how fast the page was rendered. -->
		</div>
		  	<div id="delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog" style="width:400px;margin-top:150px">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<p class="modal-title" id="myModalLabel"style="font-size:13px"><h4><i class="glyphicon glyphicon-trash"></i> Delete</h4></p>
						</div>
						<div class="modal-body" style='font-size:14px'>
							Do you really want to delete this category ?
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
							<form id="edit_cat_form">
								<div id='paste_edit_form'>
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
			fetch_categories();
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

		function fetch_categories()
		{
			$.get("handler/fetch_categories.php?page=1",function(response){
				$('#paste_categories').html(response);
			})
		}		
		function paginate(page)
		{
			$.get("handler/fetch_categories.php?page="+page,function(response){
				$('#paste_categories').html(response);
			})
		}
		function delete_cat(id,page)
		{
			$('#delete').modal('show');
			$('#proceed_btn').html("<button type='button' class='btn btn-danger' onclick=\"cont_del_cat("+id+","+page+")\">Ok</button>");
		}
		function cont_del_cat(id,page)
		{
			$.post("handler/delete_category.php",{id:id},function(response){
				$('#delete').modal('hide');
				paginate(page);
				$('#paste_response').html("<div class='alert alert-success' style='font-size:13px'><button type='button' class='close' data-dismiss='alert'>&times;</button><h4><i class='glyphicon glyphicon-check'></i> Success</h4>You have successfully added a new category</div>").slideDown().delay(8000).slideUp();
			})
		}
		function edit_cat(id,page)
		{
			$.post("handler/edit_category.php",{id:id,page:page},function(response){
				$('#paste_edit_form').html(response);
				$('#edit').modal('show');
			})
		}
		$('#edit_cat_form').submit(function(e){
			e.preventDefault();
			var category = $('#category').val();
			var page = $('#page').val();
			if(category=="")
			{
				document.getElementById("category").style.border="1px solid red";
			}
			else
			{
				$.ajax({
					url:"handler/update_category.php",
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
							paginate(page);
							$('#paste_response').html("<div class='alert alert-success' style='font-size:13px'><button type='button' class='close' data-dismiss='alert'>&times;</button><h4><i class='glyphicon glyphicon-check'></i> Success</h4>Category updated successfully</div>").slideDown().delay(8000).slideUp();
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
	</script>
</body>
</html>
