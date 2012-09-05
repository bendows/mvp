$(document).ready(function(){ 

  $('a.category').die().live('click', function(){
  	if (! $('a.linktocategories').hasClass('marked'))
			return;
    var recycles= new Array();
    $('p.recycle.marked').each(function(index) {
      recycles[index] = $(this).attr('id');
    });
		var cid = $(this).attr('id');
     $.ajax({
         dataType: "json",
         type: "POST",
         url: "linktocategories.php",
         //contentType:"text/html",
         //contentType:"application/json; charset=utf-8",
         cache:false,
         data: {
           "cid":cid,
           "snips":recycles.join()
         },
				complete: function() {
  				$('a.linktocategories').removeClass('marked');
			 	},	
         success: function(data){
           switch (data.result) {
             case 1:
						 $('p.recycle.marked').each(function(index) {
                 $(this).remove();
             });
             break;
             case 0:
               alert ('error: '+data.msg);
               break;
           }
         }
       });
		return false;
	});

  $('a.deletesnippets').die().live('click', function(){

    var answer= confirm('Delete selected snippet?');
		if (! answer)
			return false;

    var recycles = new Array();
    $('p.recycle.marked').each(function(index) {
      recycles[index] = $(this).attr('id');
    });

     $.ajax({
         dataType: "json",
         type: "POST",
         url: "deletesnips.php",
         //contentType:"text/html",
         //contentType:"application/json; charset=utf-8",
         cache:false,
         data: {
           "snips":recycles.join()
         },
        complete: function() {
        },
         success: function(data){
           switch (data.result) {
             case 1:
             $('p.recycle.marked').each(function(index) {
                 $(this).remove();
             });
             break;
             case 0:
               alert ('error: '+data.msg);
               break;
           }
         }
       });
    return false;
  });

  $('a.linktocategories').die().live('click', function(){
    if (! $(this).hasClass('marked'))
      $(this).addClass('marked');
    else
      $(this).removeClass('marked');
	});

  $('p.recycle').die().live('click', function(){
    if (! $(this).hasClass('marked'))
      $(this).addClass('marked');
    else
      $(this).removeClass('marked');
	});

  $('img.adddeletebtn').die().live('click', function(){
		var aid = $(this).closest('p').attr('id');
		var afile = $(this).attr('src');
		switch ($(this).attr('src')) {
			case '/img/nopub.gif':
			var answer=	confirm('Delete this snippet?');
			if (answer) {
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
			}
			break;
			case '/img/pub.gif':
				alert ('editing '+aid);
				break;
		};
		return false;
  });

/*
  $(document).ready(function(){ 
	$('img.adddeletebtn').addremovebuttons();
	$('p.recycle').recycle();
	$('div#selectiondiv').html('').show();
	*/
});
