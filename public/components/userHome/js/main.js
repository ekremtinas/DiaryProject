var globalTotalTime;
var globalMaintenance;
var carInfo={'car':[{'plate':'42 ER 122','carImage':'togg.jpg'},{'plate':'42 ER 123','carImage':'audi.jpg'},{'plate':'42 ER 124','carImage':'audi.jpg'},{'plate':'42 ER 125','carImage':'togg.jpg'}]};

$(document).ready(function () {


    //Information Notification Show
    $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');
    $(".notification-text").html("Enter your license plate first, then confirm this");
    $('#notificationAlert').show();


    //Car Image Get JSON License Plate Changed
    var carImage=$('#carImage');
    var goOnButton=$('#goOnButton');
    var carConfirmSwitch=$('#carConfirmSwitch');
    var miniLoading=$('#miniLoading');
    $('#licensePlate').on('keyup',function (info) {
        notificationAlert.animate({left:'1500px'}).hide('slow').animate({left:'1000px'});//Notification'un kaldırılması
        var plateInput=$(this).val();
        var lodashCar=  _.find(carInfo.car, function(o) {  return o.plate===plateInput;});
        miniLoading.attr('hidden', false);
        if(lodashCar) {
            miniLoading.attr('hidden', true);
            carImage.attr('hidden', false).attr('height','200px');
            carImage.find('img').attr('src', '/components/img/cars/' + lodashCar.carImage).attr('width','300px');

        }
        else
        {
            miniLoading.attr('hidden', false);
            carImage.attr('hidden', true);
        }

    }).blur(function () {//Input içerisinden çıktığımızda eğer boş ise loading gif'inin gizlenmesi
        var plateInput=$(this).val();
        if(!plateInput) {
            miniLoading.attr('hidden', true);
        }
        });
    //Switch Confirm My Car
    carConfirmSwitch.click(function () {
            if($(this).prop("checked") == true)
            {
                goOnButton.attr('disabled',false);
            }
            else if($(this).prop("checked") == false)
            {
                goOnButton.attr('disabled',true);
            }
    });








    //İnputlara Tıklandığında Odaklanma
    //İnput Start
    $('input[type=text]').focus(function(){

        $("nav").css("-webkit-filter", "blur(5px)");
        $("#image").css("-webkit-filter", "blur(4px)");

        $("form").css("-webkit-filter", "blur(0px)");


    }).blur(function () {

        $("nav").css("-webkit-filter", "blur(0px)");
        $("#image").css("-webkit-filter", "blur(0px)");
        $("form").css("-webkit-filter", "blur(0px)");
    });
    //İnput End

    //Checkboxlara Tıklandığında Gölgelendirme Yapılması
    // Checbox Start

    $("input[name='maintenance[]']").focus(function () {
        $('#maintenanceTable').attr('style','box-shadow :0 1px 3px rgba(0, 0, 0, 0.16), 0 1px 1px rgba(0, 0, 0, 0.23) !important;');

    }).blur(function () {
        $('#maintenanceTable').attr('style','box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23) !important;');
    });
    //Checkbox End

    $("input[name='maintenance[]']").click(function(){

        if($("input[name='maintenance[]']:checked").length >3)
        {
            $("input[name='maintenance[]']").prop("checked", false);

        }
        else {
            $("input[name='maintenance[]']").removeAttr("disabled");
        }



    });



    // Notification Start
    var notificationHide=$('#notificationHide');
    var notificationAlert=$('#notificationAlert');
    notificationHide.on('click',function () {
        notificationAlert.animate({left:'1500px'}).hide('slow').animate({left:'1000px'});

    });
    // Notification End
    //Label Kaydırma Start
    var licensePlateFB = $('#licensePlate');
    var licensePlateLabel = $('#licensePlate-label');
    licensePlateFB.focus(function()
    {
        licensePlateLabel.show().animate({top: '-25px'});
    }).blur(function () {
        licensePlateLabel.animate({top: '0px'}).hide();
    });

    var fullName = $('#fullName');
    var fullNameLabel = $('#fullName-label');
    fullName.focus(function()
    {
        fullNameLabel.show().animate({top: '-25px'});
    }).blur(function () {
        fullNameLabel.animate({top: '0px'}).hide();
    });

    var email = $('#email');
    var emailLabel = $('#email-label');
    email.focus(function()
    {
        emailLabel.show().animate({top: '-25px'});
    }).blur(function () {
        emailLabel.animate({top: '0px'}).hide();
    });

    var gsm = $('#gsm');
    var gsmLabel = $('#gsm-label');
    gsm.focus(function()
    {
        gsmLabel.show().animate({top: '-25px'});
    }).blur(function () {
        gsmLabel.animate({top: '0px'}).hide();
    });

    var country = $('#country');
    var countryLabel = $('#country-label');
    country.focus(function()
    {
        countryLabel.show().animate({top: '-25px'});
    }).blur(function () {
        countryLabel.animate({top: '0px'}).hide();
    });

    var lang = $('#lang');
    var langLabel = $('#lang-label');
    lang.focus(function()
    {
        langLabel.show().animate({top: '-25px'});
    }).blur(function () {
        langLabel.animate({top: '0px'}).hide();
    });



    //Label Kaydırma End


//Chrome Geri Tuşu Confirm


    if (window.history && window.history.pushState ) {

        window.history.pushState('forward', null, './#forward');

        $(window).on('popstate', function() {
            bootbox.confirm({
                    message: "The transactions were not completed.Are you sure you want to quit?",
                    size: 'small',
                    buttons: {
                        confirm: {
                            label: 'Yes',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn-danger'
                        }
                    },
                    callback: function (result) {

                       if(result)
                       {

                           location.reload();
                           return result;
                       }
                       else
                       {
                           return !result;
                       }
                    },
                backdrop: true,
                }

            );
        });

    }
   /* window.onbeforeunload = function(e) {
       console.log(e)
    };*///Refresh Button Works
    //Chrome Back End Button End
// Ajax ile Bakım Türlerinin Getirilip Tablo'ya eklenmesi


    //Bakım Türlerinin Getirilmesi
    $.ajax({
        url:'/getUserMaintenance',
        type:'get',
        data:{
            _token:'0GTwvcp5NWn7zBVtu6lSH4R5GhTRLaCYDoJvnqNT'
        },
        dataType:'json',
        success:function (maintenanceData) {


            for(j=0;j<maintenanceData.length;j++)
            {

                var maintenance ='('+moment(maintenanceData[j]["maintenanceMinute"], "HH:mm").format("HH:mm")+') '+maintenanceData[j]["maintenanceTitle"];
                $('#maintenanceTableEdit').append( '<tr style="line-height: 1px !important;" class="maintenanceEditRow" ><td  class="checkboxMaintenance">'+maintenance+'</td> <td ><div class=" custom-switch custom-control ">  <input class="custom-control-input  checkboxMaintenanceInput "  type="checkbox" value="'+maintenance+'" name="maintenance[]" id="maintenanceEdit'+j+'" > <label for="maintenanceEdit'+j+'" class="custom-control-label   "></label></div></td></tr>');/*Edit Form'a Güncellenen verinin eklenmesi*/


            }

        }
    });



    var editUserEventSubmit=$('#editUserEventSubmit');
    var chooseMessage=$('#chooseMessage');
    jQuery(document).on('click', "input[name='maintenance[]']" , function(event){
        var totalHour='00';
        var totalMinute='00';
        var totalTime;
        totalHour=parseInt(totalHour);
        totalMinute=parseInt(totalMinute);
        $.each($("input[name='maintenance[]']:checked"),function () {
            var maintenanceCheckbox = $(this).val();
            var maintenanceHour = maintenanceCheckbox.substr(1, 2);
            var maintenanceMinute = maintenanceCheckbox.substr(4, 2);

            maintenanceMinute=parseInt(maintenanceMinute);
            maintenanceHour=parseInt(maintenanceHour);
            totalHour=totalHour+maintenanceHour;
            totalMinute=totalMinute+maintenanceMinute;
        });

        if(totalMinute>=60)
        {
            totalHour++;
            totalMinute=0;
        }
        if(totalMinute==0)
        {
            totalTime='0'+totalHour+':'+'0'+totalMinute;

        }
        else
        {
            totalTime='0'+totalHour+':'+totalMinute;

        }
       globalTotalTime=moment(totalTime,"HH:mm");

       if(timeDiffMoment<moment(totalTime,"HH:mm"))
       {

           editUserEventSubmit.attr('disabled',true);
           chooseMessage.html("<div class=\"bvalidator-red-tooltip\" style=\"top:10px; left: 300.328px;\"><div class=\"bvalidator-red-arrow\"></div><div class=\"bvalidator-red-msg\"><div>Election Exceeded.</div>\n" +
               "</div></div>");
       }
       else
       {

           editUserEventSubmit.attr('disabled',false);
           chooseMessage.html('');
       }

        totalHour=0;
        totalMinute=0;


    });
    //FullCalendar Top Button
    var count=0;
  if (window.matchMedia('(max-width: 767px)').matches) {

       //console.log('as');


    }
    $( window ).resize(
        function (){

            $.each($(".btn-primary"),function () {

                  for (i=3;i<count;i++) {
                    if (window.matchMedia('(max-width: 767px)').matches) {

                        $(this).hide();


                    } else {


                        $(this).show();


                    }
                }
                count++;
        });
            count=0;
        });






});
