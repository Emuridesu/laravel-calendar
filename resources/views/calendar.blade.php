<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calendar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
<div id="calendar"></div>

<!-- Event Modal -->
<div id="eventModal-add" class="modal micromodal-slide" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <header class="modal__header">
                <h2 class="modal__title" id="modal-title">イベント情報</h2>
                <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content">
                <form id="eventForm"> <!-- イベントを入力するフォーム -->
                    <label for="eventName">イベント名:</label>
                    <input id="edit_start_date" value type="hidden"/>
                    <input id="edit_end_date" value type="hidden"/>
                    <input type="text" id="eventName" name="eventName" required>
                    <button id="sendButton" type="button">送信</button>
                </form>
            </main>
            <footer class="modal__footer">
                <button class="modal__btn" data-micromodal-close aria-label="Close modal">閉じる</button>
            </footer>
        </div>
    </div>
</div>
    <!-- Event Modal -->
    <div id="eventModal-update" class="modal micromodal-slide" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <header class="modal__header">
                <h2 class="modal__title" id="modal-title">イベント情報</h2>
                <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content">
                <form id="eventForm"> <!-- イベントを入力するフォーム -->

<!--label forをupdateNameに変更　textをupdate_nameに変更したら、処理が動いた-->
                    <label for="updateName">イベント名:</label>
                    <input id="edit_update_id" value type="hidden"/>
                    <input id="edit_update_start_date" value type="hidden"/>
                    <input id="edit_update_end_date" value type="hidden"/>
                    <input type="text" id="updateName" name="updateName">
                    <button id="updateButton" type="button">更新</button>
                    <button id="deleteButton" type="button">削除</button>
                </form>
            </main>
            <footer class="modal__footer">
                <button class="modal__btn" data-micromodal-close aria-label="Close modal">閉じる</button>
            </footer>
        </div>
    </div>
</div>
</body>
</html>

