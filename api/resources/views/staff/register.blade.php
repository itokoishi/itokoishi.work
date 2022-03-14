@extends('layouts.front-main')

@section('page-css')
    <link rel="stylesheet" href="/css/staff.css">
@endsection

@section('page-js')
    <script>
        $(function () {
            /* -------------------------------------
             登録ボタン
            ------------------------------------- */
            $(document).on('click', '#register-modal-bt', function () {
                $('#register-modal').remodal().open();
                return false;
            })

            $(document).on('click', '#register-bt', function () {
                $('#staff-register-form').submit();
                return false;
            });

            /* -------------------------------------
             画像削除
            ------------------------------------- */
            $(document).on('click', '#delete-photo-bt', function () {
                let token = $('input[name="_token"]').val();
                let url = '/image/staff/tmp/delete';

                // Ajax通信を開始
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    // フォーム要素の内容をハッシュ形式に変換
                    data: {
                        '_token': token
                    },
                    timeout: 5000,
                })
                    .done(function (data) {
                        console.log(data);
                        if (data['result']) {
                            $('#photo-box').html('<div class="image-box">' +
                                '<img src="/image/staff/default" class="staff-image" width="250" />' +
                                '<a href="/admin/staff/photo?type=register" class="btn btn-warning btn-sm">' +
                                '写真を登録 ' +
                                '</a>' +
                                '<div>');
                        } else {
                            alert('削除失敗しました');
                        }
                    })
                    .fail(function (data) {
                        console.log(data);
                    });
                return false;
            });
        });
    </script>
@endsection

@section('main-contents')
    <article>
        <h1>スタッフ登録</h1>

        <section>
            <form id="staff-register-form" method="post">
                <table class="table table-striped table-bordered" id="event-register">

                    <!--= 写真登録 =======================-->
                    <tr>
                        <th>写真登録</th>
                        <td id="photo-box">
                            <div class="image-box">
                                <img src="/image/staff/default" class="staff-image" width="250"/><br>

                                <a href="/staff/photo?type=register" class="btn btn-warning btn-sm">
                                    写真を登録
                                </a>
                            </div>
{{--                            <div class="image-box">--}}
{{--                                <img src="/image/staff/tmp" class="staff-image" width="250" height="250"/><br>--}}

{{--                                <a href="" class="btn btn-danger btn-sm" id="delete-photo-bt">--}}
{{--                                    写真を削除--}}
{{--                                </a>--}}
{{--                            </div>--}}
                        </td>
                    </tr>

                    <!--= 名前 =======================-->
                    <tr>
                        <th>名前<span class="note">必須</span></th>
                        <td>
                            <input name="name" value="" class="form-control w500">
                            @error('name')
                            <span class="note">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>

                    <!--= なまえ(かな) =======================-->
                    <tr>
                        <th>なまえ(かな)<span class="note">必須</span></th>
                        <td>
                            <input name="name_kana" value="" class="form-control w500">
                            @error('name_kana')
                            <span class="note">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>

                    <!--= 生年月日 =======================-->
                    <tr>
                        <th>生年月日<span class="note">必須</span></th>
                        <td>
                            <select name="year" class="form-control w100 middle-line">
                                @foreach($year_item as $val)
                                    <option value="{{$val['val']}}" {{old('year', $val['initialize']) == $val['val'] ? 'selected=selected':'' }}>{{$val['val']}}</option>
                                @endforeach
                            </select>

                            <p class="middle-line">年</p>

                            <select name="month" class="form-control w50 middle-line">
                                @foreach($month_item as $val)
                                    <option value="{{$val}}">{{$val}}</option>
                                @endforeach
                            </select>

                            <p class="middle-line">月</p>

                            <select name="date" class="form-control w50 middle-line">
                                @foreach($date_item as $val)
                                    <option value="{{$val}}">{{$val}}</option>
                                @endforeach
                            </select>

                            <p class="middle-line">日</p>

                            @error('year')
                            <span class="note">{{ $message }}</span>
                            @enderror

                            @error('month')
                            <span class="note">{{ $message }}</span>
                            @enderror

                            @error('date')
                            <span class="note">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>

                    <!--= 表示設定 =======================-->
                    <tr>
                        <th>表示設定</th>
                        <td>
                            <select class="form-control w150">
                                <option value="0">表示しない</option>
                                <option value="1">表示する</option>
                            </select>
                            @error('name_kana')
                            <span class="note">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                </table>
                @csrf
            </form>

            <div id="register-bt-box">
                <a href="" class="btn btn-success" id="register-modal-bt">登録する</a>
            </div>
        </section>
    </article>

    <section class="remodal" id="register-modal" data-remodal-id="register-modal" data-remodal-options="hashTracking:false">
        <h1>スタッフ登録</h1>

        <p>スタッフを登録しますか？</p>
        <a data-remodal-action="cancel" class="remodal-cancel">閉じる</a>
        <a data-remodal-action="cancel" class="remodal-confirm" id="register-bt">登録する</a>
    </section>
@endsection
