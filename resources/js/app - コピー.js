import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import axios from 'axios';

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

        //alert("selected " + info.startStr + " to " + info.endStr);

        // 入力ダイアログ
        const eventName = prompt("イベントを入力してください");

        if (eventName) {
            // Laravelの登録処理の呼び出し
            axios
                .post("/schedule-add", {
                    start_date: info.start.valueOf(),
                    end_date: info.end.valueOf(),
                    event_name: eventName,
                })
                .then(() => {
                    // イベントの追加
                    calendar.addEvent({
                        title: eventName,
                        start: info.start,
                        end: info.end,
                        allDay: true,
                    });
                })
                .catch(() => {
                    // バリデーションエラーなど
                    alert("登録に失敗しました");

                });
        }
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
                    // 更新成功時の処理（ここでは特に何もしません）
                })
                .catch(() => {
                    // 更新失敗時の処理
                    alert("更新に失敗しました");
                });
            }
        },

    });



calendar.render();
