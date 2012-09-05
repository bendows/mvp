$(document).ready(function(){ 
  $('tr.category').die().live('click', function(){
		if (! $(this).hasClass('marked'))
			$(this).addClass('marked');
		else 
			$(this).removeClass('marked');
	});
  $('img.deletecategory').die().live('click', function(){
    var answer = confirm('Delete this category?');
    if (! answer) 
			return false;
		var aimg = this;
    var aid = $(this).attr('id');
     $.ajax({
         dataType: "json",
         type: "POST",
         url: "category_delete.php",
         //contentType:"text/html",
         //contentType:"application/json; charset=utf-8",
         cache:false,
         data: {
           "cats":aid
         },
         success: function(data){
           switch (data.result) {
             case 1:
               $(aimg).parent().parent().remove();
               break;
             case 0:
               alert ('error: '+data.msg);
               break;
           }
         }
       });
     });

	$('a.deletecategories').die().live('click', function(){
    var answer= confirm('Delete selected cateogies?');
		if (! answer) 
			return false;
			var cats=new Array();
			$('table#categories tr.category.marked').each(function(index) {
				cats[index] = $('td img', this).attr('id');
			});
      $.ajax({
          dataType: "json",
          type: "POST",
          url: "category_delete.php",
          //contentType:"text/html",
          //contentType:"application/json; charset=utf-8",
          cache:false,
          data: {
            "cats":cats.join()
          },
          success: function(data){
            switch (data.result) {
              case 1:
								$('table#categories tr.category.marked').each(function(index) {
									$(this).remove();
								});
                break;
              case 0:
                alert ('error: '+data.msg);
                break;
            }
          }
        });
	});
});
