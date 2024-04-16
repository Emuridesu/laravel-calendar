<!DOCTYPE html>
<html lang="en">
<head>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calendar</title>
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
                    <button type="button" onclick="send(info)">送信</button>
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

