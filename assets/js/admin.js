(function($){
  
    $("button#saveSetting").on("click", function(){

        let endpoint = $("#endpoint").val()
        let cache = $("#cache").val()
        let theme = $("#theme").val()
     
      $.ajax({
          url: ajaxurl,
          method: "POST",
          data: {
            action: "setSettings",
            endpoint: endpoint,
            cache: cache,
            theme: theme,
          },
          beforeSend: function () {
          
          },
    
          success: function (data) {
      
         
            $("#notifications").html(`<div class="notice notice-success  is-dismissible">
            <p>The changes were applied</p>
          
            </div>`)
          },
          error: function (error) {
         
            $("#notifications").html(`<div class="notice notice-error   is-dismissible">
            <p>${error}</p>
           
            </div>`)
          },
        });
     setTimeout(function () {
      $("#notifications").html('')
     }, 5000)
  })
  
})(jQuery)
