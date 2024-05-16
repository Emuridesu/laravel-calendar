import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import axios from 'axios';
import MicroModal from 'micromodal';



var calendarEl = document.getElementById("calendar");

let calendar = new Calendar(calendarEl, {
    plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin, listPlugin],
    initialView: "dayGridMonth",
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,listWeek",
    },
    locale: "ja",

    // 日付をクリック、または範囲を選択したイベント
    selectable: true,


    select: function (info) {
        MicroModal.init({ disableScroll: true });
        MicroModal.show('eventModal-add'); // モーダルを表示する
        //alert("selected " + info.startStr + " to " + info.endStr);
        document.getElementById('edit_start_date').value = info.start.valueOf();
        document.getElementById('edit_end_date').value = info.end.valueOf();
        console.log(calendar);
    },

    events: function (info, successCallback, failureCallback) {
        // Laravelのイベント取得処理の呼び出し
        axios
            .post("/schedule-get", {
                start_date: info.start.valueOf(),
                end_date: info.end.valueOf(),
            })
            .then((response) => {
                // 追加したイベントを削除
                calendar.removeAllEvents();
                // カレンダーに読み込み
                successCallback(response.data);

            })
            .catch(() => {
                // バリデーションエラーなど
                alert("登録に失敗しました");
            });
    },


    eventClick: function(info) {
        MicroModal.init({ disableScroll: true });
        MicroModal.show('eventModal-update'); // モーダルを表示する

        document.getElementById('edit_update_id').value = info.event._def.extendedProps.event_id;// クリックされたイベントのIDを取得
        document.getElementById('edit_update_start_date').value = info.event.start.valueOf(),
        document.getElementById('edit_update_end_date').value = info.event.end.valueOf(),

        console.log(info.event._def.extendedProps.event_id); //追記 eventIdが出力できるか確認する
        console.log(info.event.title); //追記 出力できるか確認する
        console.log(info.event.start.valueOf());//追記 出力できるか確認する
        console.log(info.event.end.valueOf());//追記 出力できるか確認する
        },

    });


calendar.render();
