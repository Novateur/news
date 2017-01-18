				$('#login_form').submit(function(e){
					e.preventDefault();
					var email,password;
					email = $('#email').val();
					password = $('#password').val();
					
					if(email=="" || password=="")
					{
						if(email=="")
						{
							document.getElementById("email").style.border="1px solid red";
						}						
						if(password=="")
						{
							document.getElementById("password").style.border="1px solid red";
						}
					}
					else
					{
						
						$.ajax({
							url:"handler/login.php",
							type:"POST",
							data: new FormData(this),
							cache:false,
							contentType:false,
							processData:false,
							success:function(data)
							{
								if(data=="yes")
								{
									$('#signin').modal('hide');
									location.assign("admin/admin_index.php");
								}
								else
								{
									$('#error_response').html("<div class='alert alert-danger' style='font-size:13px'><button type='button' class='close' data-dismiss='alert'>&times;</button><h4><i class='glyphicon glyphicon-times'></i> Error</h4>Incorrect Username/Password combination</div>");
								}
							}

						})
					}
				})
