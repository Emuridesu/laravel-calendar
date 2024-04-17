<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calendar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div id='calendar'></div>

<!-- Event Modal -->
<div id="eventModal" class="modal micromodal-slide" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <header class="modal__header">
                <h2 class="modal__title" id="modal-title">イベント情報</h2>
                <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content">
                <form id="eventForm"> <!-- イベントを入力するフォーム -->
                    <label for="eventName">イベント名:</label>
                    <input type="text" id="eventName" name="eventName" required>
                    <button type="button" onclick="send(globalInfo)">
                    送信</button>
                </form>
            </main>
            <footer class="modal__footer">
                <button class="modal__btn" data-micromodal-close aria-label="Close modal">閉じる</button>
            </footer>
        </div>
    </div>
</div>

<script>
    function send(globalInfo) {

    console.log(globalInfo);

const eventName = document.getElementById('eventName').value; // イベント名を取得
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
                     MicroModal.close('eventModal'); // モーダルを閉じる
                })
                .catch(() => {
                    // バリデーションエラーなど
                    alert("登録に失敗しました");

                });
            }
        }
</script>
</body>
</html>

