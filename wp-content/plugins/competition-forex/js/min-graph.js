function draw2(pointy, container) {		
	var ph = container;
	var position = ph.offset();
	//alert(container.width());
	//поправка длины оси x в зависимости от количества точек y
	var amendment = 0;
	if (pointy.length< 6) amendment = 30;
	//параметры
	var physical_height = []; physical_height.x = ph.width()+amendment; physical_height.y = ph.height()-20; //длина оси
	var count_ticks =[]; count_ticks.x = pointy.length; count_ticks.y = 10; //количество делений
	var physical_offset=[]; physical_offset.x=(physical_height.x)/pointy.length; //физическое смещение	
	//координаты и задание полотна
	paper = Raphael(position.left+10,position.top-10, physical_height.x, 80);
	//var paper = Raphael(container_id, 30, 30);
	//координаты осей        
	var axis_begin = []; axis_begin.x = 0; axis_begin.y = ph.height(); //нижн¤¤ граница
	var axisend = []; axisend.x = position.left+ph.width(); axisend.y = position.top; // конец осей
	//поиск минимального и максимального значени¤ и коэффициента
	var minel = Math.min.apply({},pointy); //минимальный элемент
	var maxel = Math.max.apply({},pointy); //максимальный элемент 
	var level_grid = physical_height.y/(maxel-minel); //коэффициент	
	var axis_0 = []; axis_0.x = axis_begin.x; // 0 - ось
	// если минимальное число отрицательное
	if (Math.sign(minel) == -1) axis_0.y = axis_begin.y + level_grid*minel; // делаем смещение дл¤ 0 оси
	else axis_0.y = axis_begin.y; // равн¤ем 0 ось по нижнему краю
	//вывод графика
	var y=0;       
	var bgpth = "M"+(axis_0.x)+" "+(axis_0.y);       
	for (var x=0; x<pointy.length; x++)
	{
		l = paper.path(bgpth+" L"+(axis_0.x+x*physical_offset.x)+" "+(axis_0.y-level_grid*pointy[y]));
		bgpth = "M"+(axis_0.x+x*physical_offset.x)+" "+(axis_0.y-level_grid*pointy[y]);
		l.attr({stroke: "#993300","stroke-width":1});
		y++;	
	}
}

function create_small_graf()
{
    jQuery(".competition-forex-participants tr.account-row").each(function () {
       //var loginSelector = $(this); 
       //alert(this);
       var loginSelector = jQuery(this).attr('id'); 
       var drawField = jQuery(".competition-forex-participants tr#" + loginSelector + " td.graph");
       var account = loginSelector.replace("participant","");
       //var drawField = $("#graf" + login);      
       //alert(login);      
       jQuery.ajax({
            type:"POST",
            datatype: "json",
            url: "/wp-admin/admin-ajax.php",
            data: {
                action: 'grafdate_get',
                account: account
            },
            success:function(data){
                var data_formatted = JSON.parse(data);		
                var deposit = data_formatted[0].balance;               
                var balance_percent=[];
                for (var i=0; i<data_formatted.length; i++)
                {
                        var bp= data_formatted[i].balance/deposit*100-100;
                        balance_percent.push(bp);					
                } 
                draw2(balance_percent, drawField);
            },
             error: function(xhr, status) {
                    //alert('Ошибка');
            }			
	});
   });
}

jQuery(window).resize(function($) {
    //alert("изменение");
    jQuery("svg").remove();
    create_small_graf();
});

jQuery(document).ready(function($) {
    $(".competition-forex-participants tr.account-row").each(function () {
       var loginSelector = $(this).attr('id');
        var drawField = $(".competition-forex-participants tr#" + loginSelector + " td.graph");
        console.log(drawField);
        var account = loginSelector.replace("participant","");
        
        jQuery.ajax({
            type:"POST",
            //datatype: "json",
            url: "/wp-admin/admin-ajax.php", 
            data: {
               action: 'grafdate_get',
               account: account
            },
            success:function(data){
               var data_formatted = JSON.parse(data);
               var deposit = data_formatted[0].balance;
               var balance_percent=[];
               for (var i=0; i<data_formatted.length; i++)
                {
                        var bp= data_formatted[i].balance/deposit*100-100;
                        balance_percent.push(bp);					
                }
                draw2(balance_percent, drawField);
            },
            error: function(xhr, status) {
                    //alert('Ошибка');
            }
        });
    });
}); 