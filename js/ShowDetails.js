  $(function()
  {
    $("#trigger").click(function(event) {
      event.preventDefault();
      $("#box").slideToggle();
    });
    
    $("#box a", this).click(function(event) {
      event.preventDefault();
      $("#box").slideUp();
    });
  });
  