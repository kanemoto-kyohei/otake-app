<x-mail::message>
# 予約が完了しました

<h1>{{ $appoint_user->name }}さん</h1>
<h2>予約日時</h2>
<p>{{$appoint_user->date}}<br>{{$appoint_user->time}}</p>


ご利用いただきありがとうございます<br>
{{ config('app.name') }}
</x-mail::message>
