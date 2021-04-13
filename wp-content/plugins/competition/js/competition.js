
function setCookiesPairs(pairData)
{
    var pairsJson = jQuery.cookie('competition_pairs');
    if (!pairsJson) {
        var pairs = [pairData];
    } else {
        pairs = jQuery.parseJSON(pairsJson);
        pairs.push(pairData);       
    }
    pairsJson = JSON.stringify(pairs);
    jQuery.cookie('competition_pairs', pairsJson, {
        expires: 5
    });         
}

function updateFormCookies(pairInfo)
{   
    pair = pairInfo["pair"];
    pair_selector = '.' + formatToSelector(pair);
    jQuery(pair_selector + ' .forecast').val(pairInfo["forecast"]);
    jQuery(pair_selector + ' .forecast').attr('readonly', true);
    jQuery(pair_selector + ' .uuid').val(pairInfo["uuid"]);
    jQuery(pair_selector + ' .uuid').attr('readonly', true);
    jQuery(pair_selector + ' .partbtnblock').empty();
    jQuery(pair_selector + ' .partbtnblock').html("<div>Ваш прогноз был принят</div>");       
}

function formatToSelector(str)
{
    str_selector = str.toLowerCase();
    str_selector = str_selector.replace("/","-");
    return str_selector;   
}

jQuery(document).ready(function() {
    //alert("text");
    var cookiesPairs = jQuery.cookie('competition_pairs');
    //alert(cookiesPairs.length);
    /** временно убрал проверку на куки
    if (cookiesPairs) {
        pairs = jQuery.parseJSON(cookiesPairs);
        //alert(pairs.length);
        for (var index = 0; index < pairs.length; ++index) {            
            updateFormCookies(pairs[index]);
        }
        
    }
    */

    jQuery('.participate__btn').click(function(){
        
        var pair = jQuery(this).attr('data-pair');    
        var pair_block_selector = pair.toLowerCase();
        pair_block_selector = '.' + pair_block_selector.replace("/","-");   
        //forecast
        var forecast = jQuery(pair_block_selector + ' .forecast').val();      
        if (forecast == '') {          
            alert("введите корректный прогноз");
            return;
        }
        forecast.replace(",",".");
        //uuid
        var uuid = jQuery(pair_block_selector + ' .uuid').val(); 
        if (uuid == '') {        
            alert("введите уникальный код");
            return;
        }   
        var regexp = new RegExp('^[a-zA-Z0-9]{12,20}$');
        if (!(regexp.test(uuid))) {        
            alert(uuid + "вы ввели неверный уникальный код");
            return;
        }

        console.log(forecast + ' ' + uuid + ' '+ pair);
        jQuery.ajax({
            type: "POST",
            url: "/wp-admin/admin-ajax.php",           
            data: {                  
                    action: 'participate',
                    forecast: forecast,
                    uuid: uuid,
                    pair: pair
            },  
            success:function(data){          
                //alert(data);
                console.log(data);
                var data = jQuery.parseJSON(data);
                //alert(obj.message);
                var answerCode = data.code;
                //alert(answerCode);

                console.log(data);
                switch (answerCode) {
                    case 1: 
                        var pairData = {
                            pair: pair,
                            uuid: uuid,
                            forecast: forecast
                        };
                        setCookiesPairs(pairData);
                        updateFormCookies(pairData);                   
                        alert("Ваш прогноз принят");
                        break;
                    case 2:
                        alert("Уникальный код не найден");
                        break;  
                    case 3:
                        var pairData = {
                            pair: pair,
                            uuid: uuid,
                            forecast: forecast
                        };
                        setCookiesPairs(pairData);
                        updateFormCookies(pairData);
                        alert("Повторная отправка уникального кода");
                        break;
                    case 4:
                        alert("Ошибка");
                        break;                                  
                }
                
            },
            error: function(xhr, status) {
                alert(xhr.status);
            }
        });        
    });
});

