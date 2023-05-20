<x-mail::message>
# カレンダーに予約が追加されました


{{ $appoint_info->name }}さんが予約を追加しました
<x-mail::button :url="route('appoint.top')">
カレンダーを見る
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
