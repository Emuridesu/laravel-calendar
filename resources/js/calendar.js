import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import axios from 'axios';
import MicroModal from 'micromodal';



var calendarEl = document.getElementById("calendar");

const sendButton = document.getElementById("sendButton");
console.log(sendButton); //とりあえずコンソールで出力する
sendButton.addEventListener("click", send);

const updateButton = document.getElementById("updateButton");
updateButton.addEventListener("click", update);

const deleteButton = document.getElementById("deleteButton");
deleteButton.addEventListener("click", Delete);

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
console.log(calendar); //内容がthen()の中に書いたconsole.log()と出力が同じか
function send() {

    console.log(calendar);
const startDate = document.getElementById('edit_start_date').value;
const endDate = document.getElementById('edit_end_date').value;
const eventName = document.getElementById('eventName').value; // イベント名を取得
const userId = document.getElementById('eventName').value; // イベント名を取得



    if (eventName) {
        // Laravelの登録処理の呼び出し
        axios
            .post("/schedule-add", {
                start_date: startDate,
                end_date: endDate,
                event_name: eventName,

            })

            .then(() => {

                //location.reload(); // ページを再読み込み
                MicroModal.close('eventModal-add'); // モーダルを閉じる
                console.log(calendar);
                // イベントの追加
                    calendar.addEvent({
                    title: eventName,
                    start: startDate,
                    end: endDate,
                    allDay: true,
                    });
                location.reload(); // ページを再読み込み

            })
            .catch((error) => {
                //console.error("エラーが発生しました:", error);
                alert("登録に失敗しました");

            })
        }
    }

function update() {
    const eventId = document.getElementById('edit_update_id').value
    const startDate = document.getElementById('edit_update_start_date').value;
    const endDate = document.getElementById('edit_update_end_date').value;
    const eventName = document.getElementById('updateName').value; // イベント名を取得


    if (eventName) {
        axios
            .post("/schedule-update", {
                event_id: eventId,
                start_date: startDate,
                end_date: endDate,
                event_name: eventName,
            })
            .then(() => {
                MicroModal.close('eventModal-update'); // モーダルを閉じる
                location.reload(); // ページを再読み込み
            })
            .catch(() => {
                // 更新失敗時の処理

                alert("更新に失敗しました");
            });
        }
    }

    function Delete() {
        const eventId = document.getElementById('edit_update_id').value
        const startDate = document.getElementById('edit_update_start_date').value;
        const endDate = document.getElementById('edit_update_end_date').value;


        if (eventName) {
            axios
                .post("/schedule-delete", {
                    event_id: eventId,
                    start_date: startDate,
                    end_date: endDate,
                })
                .then(() => {
                    MicroModal.close('eventModal-update'); // モーダルを閉じる
                    location.reload(); // ページを再読み込み
                })
                .catch(() => {
                    // 更新失敗時の処理

                    alert("更新に失敗しました");
                });
            }
        }
