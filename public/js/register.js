// const inputs = document.querySelectorAll(".input");

// function addcl() {
//     let parent = this.parentNode.parentNode;
//     parent.classList.add("focus");
// }

// function remcl() {
//     let parent = this.parentNode.parentNode;
//     if (this.value == "") {
//         parent.classList.remove("focus");
//     }
// }


// inputs.forEach(input => {
//     input.addEventListener("focus", addcl);
//     input.addEventListener("blur", remcl);
// });

$('input').focus(function(){
    // console.log("object");
   let div= $(this).parent().children('span').html('');
//    console.log(div);
})

$(document).ready(function(){

$('#register').click(function(e){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    let name= $('#name').val();
    let email= $('#email').val();
    let password= $('#password').val();
    let password_confirmation= $('#password_confirmation').val();
    $.ajax({
        url:'/register',
        type:"POST",
        data:{
            name:name,
            email:email,
            password:password,
            password_confirmation:password_confirmation
        },
        // dataType:"JSON",
        success:function(response){
            $("span[id^=invalid]").html('');
            console.log(response);
            if(response.status==200){
				
                Swal.fire({
                    title: 'Success!',
                    text: 'Registration Successfully.',
                    icon:'success',
                    timer: 1000
                 }).then(function () {
                    window.location = '/login';
                });
            }
        },
        error:function(xhr){
            $("span[id^=invalid]").html('');
                  $.each(xhr.responseJSON.message, function(key,value) {
                $('#invalid-'+key+'').html(value);
            });
       }

    });

});


});
