<x-mail::message>
# カレンダーに予約が追加されました


{{ $appoint_user->name }}さんが予約を追加しました
<x-mail::button :url="route('admin.inertialink')">
カレンダーを見る
</x-mail::button>

ご利用いただきありがとうございます<br>
{{ config('app.name') }}
</x-mail::message>
