jQuery('button.registration').click(function(event){
    //alert("ss");
    var data = $('.competition-forex').serializeArray();
    var postForm = {
       action: 'forex_participate' 
    };
    var error = false;
    $.each(data,function(){   
        //console.log($("input[name='"+this.name+"']").attr('placeholder'));
        //console.log(this.name+'='+this.value);
        if ($("[name='"+this.name+"']").hasClass('required') && this.value == '') {
           alert("Введите " + $("[name='"+this.name+"']").attr('placeholder').replace('*', ''));
           error = true;
           return false;
        }
        postForm[this.name] = this.value;
    });  
    if (error) {
        return false;
    }
    var uuid = jQuery('.uuid').val();
    var regexp = new RegExp('^[a-zA-Z0-9]{12,20}$');
    if (!(regexp.test(uuid))) {        
        alert("Вы ввели неверный код участника");
        return;
    }
    jQuery.ajax({
       type: "POST",
       url: "/wp-admin/admin-ajax.php", 
       data: postForm, 
       success:function(data){
           var data = jQuery.parseJSON(data);
           var answerCode = data.code;
           switch (answerCode) {
                case 0:
                    alert("Ошибка");
                    break;
                case 1:
                    alert("Вы были зарегистрированы, на вашу почту была отправлена инструкция по активации советника");
                    $(".registration-button-block").empty();
                    $(".registration-button-block").html("<div>Вы были зарегистрированы, на вашу почту была отправлена инструкция по активации советника</div>");
                    break;
                case 2:
                    alert("Не найден код участника");
                    break;
                case 3:
                    alert("Повторная подача кода участника");
                    break;
                case 4:
                    alert("Не найден код участника");
                    break;
                case 5:
                    alert("Ошибка");
                    break;
                case 6:
                    alert(data.message);
                    break;
                     
           }  
       }, 
       error: function(xhr, status) {
           alert(xhr.status);
       } 
    });
    event.preventDefault();
});

jQuery(document).ready(function($){
    $(".competition-forex-participants input.find").keypress(function(e){
      if(e.keyCode==13){
           //alert("нажата клавиша");
           login = $(".datatable1 input.find").val();
           url = $(".datatable1 input.find").data("url");
           if (login == '') {
               url = url.split('?')[0];
           } else {
               url = url + login;
           }
           
           //alert(url);
           window.location.href = url;
      }
    });
});