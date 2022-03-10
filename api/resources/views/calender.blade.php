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

            <p id="month-title">{{$str_month}}</p>

            <!-- カレンダーコンテンツ -->
            <div id="calender-nav">
                <nav class="btn-group" role="group">
                    <a id="prev-month" href="/calender?month={{$prev_month}}" class="btn btn-warning btn-xs"> 前の月</a>
                    <a id="this-month" href="/calender" class="btn btn-default btn-xs">今月</a>
                    <a id="next-month" href="/calender?month={{$next_month}}" class="btn btn-success btn-xs"> 次の月</a>
                </nav>
            </div>

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
