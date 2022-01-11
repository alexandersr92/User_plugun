(function($){
   
    $("a.userDetails").on("click", function(e){
        let id = $(this).data("id");
        console.log(id);

        $.ajax({
            url: ajaxurl,
            method: "POST",
            data: {
              action: "getSingleUser",
              userID: id
            },
            beforeSend: function () {
              console.log("enviado");
            },
      
            success: function (data) {
              console.log(data);
               $("#singleUser").html(data)
     
            },
            error: function (error) {
              console.log(error);
            },
          });
       
    })
    
  
})(jQuery)
