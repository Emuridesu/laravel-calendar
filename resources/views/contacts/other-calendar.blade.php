<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calendar</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/js/othercalendar.js'])
<a href="{{ route('dashboard') }}"
class="modal__btn">top</a>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<input type="hidden" value="{{ request()->route('id') }}" id="user_id"/></a>
</head>
<body>
<div id="calendar"></div>



</body>
</html>
