$(document).ready(function(){
   
    // $('.nav-link').click(function(e){
    $('.tech-link').click(function(e){
        e.preventDefault();
        let id= $(this).data("id");
        // console.log(id);
        if(id == null || id == undefined){
            return false;
        }
   
        
        $.ajax({
            method:"get",
            url:"/tech_data/"+id,
            success:function(response){
             if(response)
             {
    //             console.log(response,"id");
    // return false;
                window.location.href="/user_tech/"+id;
             }
            }

        });
    });

    
     
    $('.cardtech').click(function(e){
        e.preventDefault();
        var id= $(this).data("id");
        // console.log(id);
   

    
        $.ajax({
            method:"get",
            url:"/tech_data/"+id,
            success:function(response){
             if(response)
             {
                window.location.href="/user_tech/"+id;
             }
            }

        });
    });

     
    $('.slidertech').click(function(e){
        e.preventDefault();
        var id= $(this).data("id");
        // console.log(id);
   

    
        $.ajax({
            method:"get",
            url:"/tech_data/"+id,
            success:function(response){
             if(response)
             {
                window.location.href="/user_tech/"+id;
             }
            }

        });
    });
});
