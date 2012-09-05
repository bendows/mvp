;(function ( $, window, document, undefined ) {
  $.fn.recycle = function() {
    return this.each(function() {
      $(this).click(function(){
				$("div#selectiondiv")
					.append("<li id='"+$(this).attr('id')+"'>.susbstr(2, 2);</li>");
				return false;
        var that = $(this);
        if (that.parent().hasClass('show')) {
          that.parent().removeClass('show');
          that.siblings("tr").hide();
        } else {
          that.parent().addClass('show');
          that.siblings("tr").show();
        }
      });
    });
  }
  // private function for debugging
  function debug($obj) {
    if (window.console && window.console.log)
      window.console.log('hilight selection count: ' + $obj.size());
  };
}) ( jQuery, window, document );

;(function ( $, window, document, undefined ) {

  $.fn.addremovebuttons = function() {

    return this.each(function() {

  $('img.removeeditbtn').die().live('click', function(e){
    e.stopPropegation();
    var aid = $(this).closest('p').attr('id');
    if ($(this).attr('src') == '/img/nopub.gif'){
      var answer= confirm('Delete this snippet?');
      if (! answer) {
        e.stopPropegation();
        return false;
      }
      $.ajax({
          dataType: "json",
          type: "POST",
          url: "deletesnip.php",
          //contentType:"text/html",
          //contentType:"application/json; charset=utf-8",
          cache:false,
          data: {
            "aid":aid
          },
          success: function(data){
            switch (data.result) {
              case 1:
                $("p#"+aid).remove();
                break;
              case 0:
                alert ('error: '+data.msg);
                break;
            }
          }
        });
    };
    alert ('editing '+aid);
      return false;
  });
    });
  }

  //private local function
  function debug($obj) {
    if (window.console && window.console.log)
      window.console.log('hilight selection count: ' + $obj.size());
  };

}) ( jQuery, window, document );
