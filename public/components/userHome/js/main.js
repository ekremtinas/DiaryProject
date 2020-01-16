$(document).ready(function () {
    //İnputlara Tıklandığında Odaklanma
    //İnput Start
    $('input').focus(function(){

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

    $('input[type=checkbox]').focus(function () {
        $('#maintenanceTable').attr('style','box-shadow :0 1px 3px rgba(0, 0, 0, 0.16), 0 1px 1px rgba(0, 0, 0, 0.23) !important;');

    }).blur(function () {
        $('#maintenanceTable').attr('style','box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23) !important;');
    });
    //Checkbox End

    $("input[type=checkbox]").click(function(){

        if($("input[type=checkbox]:checked").length >3)
        {
            $("input[type=checkbox]").prop("checked", false);

        }
        else {
            $("input[type=checkbox]").removeAttr("disabled");
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
        licensePlateLabel.show().animate({top: '-30px'});
    }).blur(function () {
        licensePlateLabel.animate({top: '0px'}).hide();
    });
    //Label Kaydırma End

//Chrome Geri Tuşu Confirm

    if (window.history && window.history.pushState) {

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
                        console.log(result);
                        return result;
                    },
                backdrop: true,
                }

            );
        });

    }
    //Chrome Back End Button End
//Edit Modal İçin Ajax ile Bakım Türlerinin Getirilip Modal'a eklenmesi

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
                $('#maintenanceTableEdit').append( '<tr style="line-height: 1px !important;" class="maintenanceEditRow" ><td  class="checkboxMaintenance">'+maintenance+'</td> <td ><input class="checkboxMaintenanceInput custom-checkbox form-check" type="checkbox" value="'+maintenance+'"  name="maintenance[]" ></td></tr>');


            }

        }
    });
});
