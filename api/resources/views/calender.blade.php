@extends('layouts.front-main')

@section('page-css')
    <link rel="stylesheet" href="/css/style.css">
@endsection

@section('page-js')
@endsection

@section('main-contents')
    <article>
        <h1>カレンダー</h1>
        <section id="calender-content">
            <!-- 今月カレンダーコンテンツ -->
            <table class="calendar-table calender">
                <tr>
                    <th class="sun">日</th>
                    <th>月</th>
                    <th>火</th>
                    <th>水</th>
                    <th>木</th>
                    <th>金</th>
                    <th class="sat">土</th>
                </tr>

                @foreach($calender as $row)
                    @if($loop->index === 0)
                        <tr>
                    @endif

                        <td {{$row->today_flag == 1 ? 'class="today' : ''}}>
                            <span class="c-date">{{ $row->day }}</span><br>
                        </td>

                    @if(($loop->index + 1) % 7 === 0 && $loop->index !== 0)
                        </tr>
                        <tr>
                    @endif
                @endforeach
            </table>
        </section>
    </article>
@endsection
