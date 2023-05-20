<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カレンダー設定</title>
</head>
<body>
    <h1>カレンダー設定</h1>
    <form action = "{{ route('admin.save',['permalink' => $permalink]) }}" method = "post">
        @csrf
        <h2>時間の設定</h2>
        @if(isset($error))
        <p style ="color: red">{{ $error }}</p>
        @endif
        <label for="start_time">開始時間:</label>
        <select name="start_time" id="start_time">
            @for ($i = 1; $i <= 23; $i++)
                <option value="{{ $i }}">{{ $i }}:00</option>
            @endfor
        </select>

        <label for="end_time">終了時間:</label>
        <select name="end_time" id="end_time">
            @for ($i = 2; $i <= 24; $i++)
                <option value="{{ $i }}">{{ $i }}:00</option>
            @endfor
        </select>

        <label for="time_interval">時間刻み:</label>
        <select name="time_interval" id="time_interval">
            <option value="0.5">0.5</option>
            <option value="1">1</option>
            <option value="2">2</option>
        </select>

        <h2>休日の設定</h2>
        <p>休日にしたい曜日にチェックをつけてください</p>
        <div>
            @foreach (['月' => 1, '火' => 2, '水' => 3, '木' => 4, '金' => 5, '土' => 6, '日' => 7] as $day => $day_number)
                <label for="day_{{ $day_number }}">
                <input type="checkbox" name="day_{{ $day_number }}" id="day_{{ $day_number }}" value="{{ $day_number }}">
                {{ $day }}
                </label>
            @endforeach
        </div>


        <h2>祝日の設定</h2>
        <label for="holiday_setting">
            <input type="checkbox" name="holiday_setting" id="holiday_setting" value="1">
            祝日を休日から外しますか
        </label>
        <br>
        <br>
        <button type="submit">設定を保存</button>
</form>
</body>
</html>
