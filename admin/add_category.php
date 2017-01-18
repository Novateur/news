	<?php
		include_once("includes/header_menu.php");
	?>
		<div class="container">
			<div class="row">
				<button class="btn btn-warning btn-sm pull-right" onclick="show_sidebar()" id="show_menu" style="display:block">Show menu</button>
			</div>
			<div class="row"><br/>
				<div class="col-md-3">
				</div>				
				<div class="col-md-6">
					<h2><a href="#" onclick="window.history.back()" style="color:#000"><i class="fa fa-arrow-left"></i></a> Add Category</h2>
					<div class="alert alert-warning">
						You can add more than one category by seperating them with a comma(,)
						E.g xxxxx,yyyyy,dddddd.
					</div>
					<div id="result_msg"></div>
					<form id="add_cat_form">
						<label>Category name :</label><br/>
						<input type="text" class="form-control" name="category" id="category" placeholder="category name"/><br/>
						<button type="submit" class="  btn btn-default" name="add" id="add" style="border:1px solid #e68a00">Add</button>
					</form>
				</div>				
				<div class="col-md-3">
				</div>
			</div>

		</div>

		<div>
			<!-- Display how fast the page was rendered. -->
		</div>

	


	<script src="../js/jquery-2.1.3.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script>
		function fetch_source(val)
		{
			alert(val);
		}
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
		$('#add_cat_form').submit(function(e)
		{
			e.preventDefault();
			var category = $('#category').val();
			if(category=="")
			{
				document.getElementById("category").style.border="1px solid red";
			}
			else
			{	
				$('#result_msg').html("Uploading data to server...");
				$.ajax({
					url:"handler/add_category.php",
					type:"POST",
					data: new FormData(this),
					cache:false,
					contentType:false,
					processData:false,
					success:function(data)
					{
						if(data=="added")
						{
							$('#category').val("");
							$('#result_msg').html("<div class='alert alert-success' style='font-size:13px'><button type='button' class='close' data-dismiss='alert'>&times;</button><h4><i class='glyphicon glyphicon-check'></i> Success</h4>You have successfully added a new category</div>").slideDown().delay(8000).slideUp();
						}
						else
						{
							$('#result_msg').html("<div class='alert alert-success' style='font-size:13px'><button type='button' class='close' data-dismiss='alert'>&times;</button><h4><i class='glyphicon glyphicon-notification'></i> Error</h4>"+data+"</div>").slideDown().delay(8000).slideUp();
						}
					}

				})
			}
		})
	</script>
</body>
</html>
