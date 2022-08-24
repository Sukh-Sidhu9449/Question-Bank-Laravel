const inputs = document.querySelectorAll(".input");

function addcl(){
	let parent = this.parentNode.parentNode;
	parent.classList.add("focus");
}

function remcl(){
	let parent = this.parentNode.parentNode;
	if(this.value == ""){
		parent.classList.remove("focus");
	}
}


inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});

$(document).ready(function(){

	$("#login").click(function(e){

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
			}
		});
		e.preventDefault();
		var email=$("#email").val();
		var password=$("#password").val();
		// alert(email);
		// console.log(email);
		// var mydata={};

		// mydata.email=email;
		// mydata.password=password;
		// console.log(mydata);
		$.ajax({
			type: "POST",
			url: "/login",
			data: {
				email:email,
				password:password
			},
			//dataType: "dataType",
			success: function (response) {
				console.log(response);
				var result =response;
				if (result=='admin') {

					//window.location="{{route('admin/dashboard')}}";
					window.location='/admin/dashboard';
					
				}
				if(result=="user"){
					window.location="/dashboard";

				}

	//error code area--------------------------------------------------------------------------
				var error=response.error;
				if(error==""){

				}
				else{
					$('#invalid').append('<div class="alert alert-danger"style="margin-bottom:15px;">'+error+'</div');
				}
			},

			error:function(xhr){

				//  $('#invalid').html('');
   					$.each(xhr.responseJSON.errors, function(key,value) {
						$('#email').append('<div class="alert alert-danger"style="margin-bottom:15px;">'+key[0]+value+'</div');
						// $('#password').append('<div class="alert alert-danger"style="margin-bottom:15px;">'+value[1]+'</div');
					
							
					
 				}); 
			}
		//end error area-------------------------------------------------------------------------
		});

	});

});

