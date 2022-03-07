@extends('layouts.front-main')

@section('page-css')
    <link rel="stylesheet" href="/css/calender.css">
@endsection

@section('page-js')
@endsection

@section('main-contents')
    <article>
        <h1>カレンダー</h1>
        <section id="calender-content">
            <!-- カレンダーコンテンツ -->
            <ul id="calender-nav">
                <li>
                    <a id="prev-month" href="/calender?month={{$prev_month}}"> 前の月</a>
                </li>

                <li>
                    <a id="this-month" href="/calender">今月</a>
                </li>

                <li>
                    <a id="next-month" href="/calender?month={{$next_month}}"> 次の月</a>
                </li>
            </ul>

            <p id="month-title">{{$str_month}}</p>

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
