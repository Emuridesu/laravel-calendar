<div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <header class="modal__header">
                <h2>Editing my task list</h2>
                <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main>
                <form method="POST" action="{{ route('scheduleUpdate') }}">
    @csrf
                    <input type="hidden" id="id" value="id" name="start_date">
                    <input type="text" id="edit_title" name="title" value="">
                    <input type="date" id="edit_start" name="start" value="">
                    <input type="color" id="edit_color" name="textColor" value="">
                    <button class="modal__btn modal__btn-primary" type="submit">変更する</button>
                </form>
            </main>
        </div>
    </div>
</div>
