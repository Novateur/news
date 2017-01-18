			<div id="signin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog" style="margin-top:80px">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<p class="modal-title" id="myModalLabel"style="font-size:13px"><h4><i class='ion-person'></i> Sign in</h4></p>
						</div>
						<div class="modal-body" style='font-size:14px'>
							<div id="error_response"></div>
							<form id="login_form">
								<label>Email</label><br/>
								<input type="email" name="email" id="email" class="form-control" placeholder="Email"/><br/>
								<label>Password</label><br/>
								<input type="password" name="password" id="password" class="form-control" placeholder="Password"/>
						</div>
						<div class="modal-footer">
							<button class="btn btn-danger btn-rounded" data-dismiss="modal" aria-hidden="true">Close</button>
							<span id="proceed_btn"><button type='submit' class='btn btn-default' name='add' id='add' style='border:1px solid #e68a00'>Login</button></span>
						</div>
							</form>
					</div>
				</div>
			</div>
	<script src="js/jquery-2.1.3.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/login.js"></script>
	<script>
		function showDaysForm()
		{
			$('#days_form').slideToggle();
		}		
		function update_counter(id)
		{
			$.post("handler/update_counter.php",{id:id},function(response){
				alert(response);
			});
		}
	</script>
