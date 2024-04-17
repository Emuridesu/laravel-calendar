import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import axios from 'axios';
import MicroModal from 'micromodal';



var calendarEl = document.getElementById("calendar");
var globalInfo;



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
        globalInfo = info;
        MicroModal.init({ disableScroll: true });
        MicroModal.show('eventModal'); // モーダルを表示(する
        //alert("selected " + info.startStr + " to " + info.endStr);
        console.log(globalInfo);

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
        const eventId = info.event._def.extendedProps.event_id;// クリックされたイベントのIDを取得


        console.log(info.event._def.extendedProps.event_id); //追記 eventIdが出力できるか確認する

        // モーダルウィンドウを表示してイベントを編集
        const eventName = prompt("イベントを更新してください", info.event.title);


        console.log(eventName) //追記 出力できるか確認する
        console.log(info.event.start.valueOf()) //追記 出力できるか確認する
        console.log(info.event.end.valueOf()) //追記 出力できるか確認する

        if (eventName) {
            axios
                .post("/schedule-update", {
                    event_id: eventId,
                    event_name: eventName,
                    start_date: info.event.start.valueOf(),
                    end_date: info.event.end.valueOf(),
                })
                .then(() => {
                    //location.reload(); // ページを再読み込み
                })
                .catch(() => {
                    // 更新失敗時の処理
                    alert("更新に失敗しました");
                });
            }
        },

    });


calendar.render();
