
$(document).ready(function () {
    function reply_click(clicked_id)
    {
        var t =clicked_id;
        
    }
    $("#btt_friend").click(function(){ 
        var t=$(this).val();
        $.get("friend.php",{id:t}, function(data){
            $("#showif").html(data);
        });
    });
    $("#btt_photos").click(function(){ 
        var t=$(this).val();
        $.get("photo.php",{id:t}, function(data){
            $("#showif").html(data);
        });
    });
    $(".btndelete").click(function(){ 
        var t=this.id;
        console.log(t);
        $.get("deletephoto.php",{idd:t}, function(data){
            console.log(data);
            $("#scr").html(data);
        });
    });

   








    // ANIMATEDLY DISPLAY THE NOTIFICATION COUNTER.
    $('#noti_Counter')
        .css({ opacity: 0 })
        .text("!")      // ADD DYNAMIC VALUE (YOU CAN EXTRACT DATA FROM DATABASE OR XML).
        .css({ top: '-10px' })
        .animate({ top: '15px', opacity: 1 }, 500);

    $('#noti_Button').click(function () {

        // TOGGLE (SHOW OR HIDE) NOTIFICATION WINDOW.
        $('#notifications').fadeToggle('fast', 'linear', function () {
            if ($('#notifications').is(':hidden')) {
                $('#noti_Button').css('background-color', '#2E467C');
            }
            // CHANGE BACKGROUND COLOR OF THE BUTTON.
            else $('#noti_Button').css('background-color', '#FFF');
        });

        $('#noti_Counter').fadeOut('slow');     // HIDE THE COUNTER.

        return false;
    });

    // HIDE NOTIFICATIONS WHEN CLICKED ANYWHERE ON THE PAGE.
    $(document).click(function () {
        $('#notifications').hide();

        // CHECK IF NOTIFICATION COUNTER IS HIDDEN.
        if ($('#noti_Counter').is(':hidden')) {
            // CHANGE BACKGROUND COLOR OF THE BUTTON.
            $('#noti_Button').css('background-color', '#2E467C');
        }
    });

    // $('#notifications').click(function () {
    //     return false;       // DO NOTHING WHEN CONTAINER IS CLICKED.
    // });
});

