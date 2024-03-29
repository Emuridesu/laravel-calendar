@include('modal');
<!-- Micromodal.js -->
<script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>

<script>
$(document).ready(function () {
    $('#calendar').fullCalendar({
      // はじめりの曜日を月曜日に変更　デフォルトは日曜日になっており、日=0,月=１になる
    firstDay: 1,
    headerToolbar: {
                    right: 'prev,next'
                    },
    events: '/index',

     // ここから追加
    eventClick: function(info){
        document.getElementById("id").value = info.id;
        document.getElementById("edit_title").value = info.title
        document.getElementById("edit_start").value = info.start._i
        document.getElementById("edit_color").value = info.textColor
        MicroModal.show('modal-1');
    }
    });
});
</script>

