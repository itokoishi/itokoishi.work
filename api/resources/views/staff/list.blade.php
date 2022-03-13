@extends('layouts.front-main')

@section('page-css')
    <link rel="stylesheet" href="/css/staff.css">
@endsection

@section('page-js')
@endsection

@section('main-contents')
    <article>
        <h1>スタッフ一覧</h1>

        @if(session()->has('result'))
            <ul class="alert alert-{{ session('result')->tag }}">
                @foreach(session('result')->messages as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @endif

        <section id="staff-list">
            @foreach($list as $row)
                <div class="staff-content">
                    <div class="image"><img src="/image/staff/{{$row->id}}?{{$row->created_at}}"/></div>
                    <div class="name">
                        {{$row->name}}<br>
                        ({{$row->name_kana}})
                    </div>
                    <div class="birthday">
                        {{$row->birth_year}}年{{$row->birth_month}}月{{$row->birth_date}}日
                    </div>
                    <div class="bt-box">
                        <a href="/staff/modify/{{$row->id}}" class="btn btn-success btn-xs">編集する</a>
                        <a href="/staff/delete" class="btn btn-danger btn-xs">削除する</a>
                    </div>
                </div>
            @endforeach
        </section>
    </article>
@endsection
