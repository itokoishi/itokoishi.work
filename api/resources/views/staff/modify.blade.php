@extends('layouts.front-main')

@section('page-css')
    <link rel="stylesheet" href="/css/staff.css">
    <link rel="stylesheet" href="/croppie/croppie.css">
@endsection

@section('page-js')
    <script src="/croppie/croppie.js"></script>
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
                let param = []
                param['name'] = $('input[name="name"]').val();
                param['name_kana'] = $('input[name="name_kana"]').val();
                param['birth_year'] = $('select[name="year"]').val();
                param['birth_month'] = $('select[name="month"]').val();
                param['birth_date'] = $('select[name="date"]').val();

                /* -- バリデーション ---------------------*/
                let validate = isValid(param);
                if (!validate['result']) {
                    let text = '';
                    validate['message'].forEach((valid) =>{ text += '<li>' + valid + '</li>'; });
                    $('#error-message').html(text);
                    $('.alert').show();
                    return false;
                }

                $('#staff-register-form').submit();
                return false;
            });

            /*-----------------------------------------------
            写真の選択処理
            -----------------------------------------------*/
            let uploadCrop;

            uploadCrop = $('#face-photo-result').croppie({
                viewport: {width: 200, height: 200, type: 'circle'},
                boundary: {width: 250, height: 250},
                url: '/image/staff/default'
            });

            uploadCrop.on('update.croppie', function (e, cropData) {
                $('input[name="x1"]').val(cropData.points[0]);
                $('input[name="y1"]').val(cropData.points[1]);
                $('input[name="x2"]').val(cropData.points[2]);
                $('input[name="y2"]').val(cropData.points[3]);
            });

            $(document).on('change', '#staff-photo', function () {
                /* -- ファイルの読み込み ---------------------*/
                if (this.files && this.files[0]) {

                    /* -- ファイルタイプチェック ---------------------*/
                    if(this.files[0].type !== 'image/jpeg'){
                        let validate = [];
                        validate['result'] = false;
                        validate['message'] = [];
                        validate['message'][0] = '画像はjpegのみとなります。';

                        let text = '';
                        validate['message'].forEach((valid) =>{ text += '<li>' + valid + '</li>'; });
                        $('#error-message').html(text);
                        $('.alert').show();
                        return false;
                    }

                    let reader = new FileReader();

                    reader.onload = function (e) {
                        uploadCrop.croppie('bind', {
                            url: e.target.result
                        });
                        $('#face-photo-result').addClass('ready');
                    }

                    $('#select-bt').hide();
                    $('#croppie-bt-box').show();
                    reader.readAsDataURL(this.files[0]);
                }
            });

            $(document).on('click', '#croppie-bt', function () {
                uploadCrop.croppie('result', 'base64').then(function (base64) {
                    $('#face-photo-result').hide();
                    $('#crop-result img').attr('src', base64);
                    $('#select-bt').hide();
                    $('#croppie-bt-box').hide();
                    $('#crop-result').show();
                });
                return false;
            });

            /*-----------------------------------------------
            画像削除
            -----------------------------------------------*/
            $(document).on('click', '#crop-delete-bt', function () {
                $('input[name="photo"]').val(null);
                uploadCrop = $('#face-photo-result').croppie({
                    viewport: {width: 200, height: 200, type: 'circle'},
                    boundary: {width: 250, height: 250},
                    url: '/image/staff/default'
                });
                $('#face-photo-result').show();
                $('#select-bt').show();
                $('#crop-result').hide();
                return false;
            });
        });

        /**
         * バリデーション
         * @param param
         * @returns {*[]}
         */
        function isValid(param) {
            let validate = [];
            validate['result'] = true;
            validate['message'] = [];

            if (!param['name']) {
                validate['result'] = false;
                validate['message'][0] = '名前は必須です。';
            }

            if (!param['name_kana']) {
                validate['result'] = false;
                validate['name_kana'] = [];
                validate['message'][1] = 'なまえ(かな)は必須です。';
            }

            if (!param['birth_year'] || !param['birth_month'] || !param['birth_date']) {
                validate['result'] = false;
                validate['birth_day'] = [];
                validate['message'][2] = '生年月日は必須です。';
            }

            return validate;
        }
    </script>
@endsection

@section('main-contents')
    <article>
        <h1>スタッフ登録</h1>

        <ul id="error-message" class="alert alert-danger">
        </ul>

        <section>
            <form id="staff-register-form" method="post" enctype="multipart/form-data">
                <table class="table table-striped table-bordered" id="event-register">

                    <!--= 写真登録 =======================-->
                    <tr>
                        <th>写真登録</th>

                        <td id="photo-box">
                            @if(empty($modify_data->image))
                            <section id="content-box" class="">
                                <div id="face-photo-result"></div>

                                <div id="crop-result">
                                    <img src=""><br>
                                    <a href="" id="crop-delete-bt" class="btn btn-danger btn-sm">
                                        削除する
                                    </a>
                                </div>

                                <div id="select-bt">
                                    <label for="staff-photo" class="photo-upload-btn btn btn-success btn-sm">
                                        <span>画像選択</span>
                                        <input type="file" name="photo" id="staff-photo"/>
                                    </label>
                                </div>

                                <div id="croppie-bt-box">
                                    <a href="" id="croppie-bt" class="btn btn-warning btn-sm">
                                        確定する
                                    </a>
                                </div>

                                <div class="js-cord">
                                    <input type="hidden" name="x1">
                                    <input type="hidden" name="y1">
                                    <input type="hidden" name="x2">
                                    <input type="hidden" name="y2">
                                </div>
                            </section>
                            @else
                                <img src="/image/staff/{{$modify_data->id}}" class="staff-image" />
                            @endif
                        </td>
                    </tr>

                    <!--= 名前 =======================-->
                    <tr>
                        <th>名前<span class="note">必須</span></th>
                        <td>
                            <input name="name" value="{{old('name', $modify_data->name)}}" class="form-control w500">
                            @error('name')
                            <span class="note">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>

                    <!--= なまえ(かな) =======================-->
                    <tr>
                        <th>なまえ(かな)<span class="note">必須</span></th>
                        <td>
                            <input name="name_kana" value="{{old('name_kana', $modify_data->name_kana)}}" class="form-control w500">
                            @error('name_kana')
                            <span class="note">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>

                    <!--= 生年月日 =======================-->
                    <tr>
                        <th>生年月日<span class="note">必須</span></th>
                        <td>
                            <select name="birth_year" class="form-control w100 middle-line">
                                @foreach($year_items as $val)
                                    <option value="{{$val['val']}}"
                                        {{old('birth_year', $modify_data->birth_year) == $val['val'] ? 'selected=selected':'' }}>
                                        {{$val['val']}}
                                    </option>
                                @endforeach
                            </select>

                            <p class="middle-line">年</p>

                            <select name="month" class="form-control w50 middle-line">
                                @foreach($month_items as $val)
                                    <option value="{{$val}}"
                                        {{old('birth_month', $modify_data->birth_month) == $val ? 'selected=selected':'' }}>
                                        {{$val}}
                                    </option>
                                @endforeach
                            </select>

                            <p class="middle-line">月</p>

                            <select name="birth_date" class="form-control w50 middle-line">
                                @foreach($date_items as $val)
                                    <option value="{{$val}}"
                                        {{old('date', $modify_data->birth_date) == $val ? 'selected=selected':'' }}>
                                        {{$val}}
                                    </option>
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
                            <select class="form-control w150" name="view_flag">
                                <option value="0"
                                    {{old('view_flag', $modify_data->view_flag) == 0 ? 'selected=selected':''}}>
                                    表示しない
                                </option>
                                <option value="1"
                                    {{old('view_flag', $modify_data->view_flag) == 1 ? 'selected=selected':''}}>
                                    表示する
                                </option>
                            </select>
                        </td>
                    </tr>
                </table>
                @csrf
            </form>

            <div id="register-bt-box">
                <a href="" class="btn btn-info btn-sm" id="register-modal-bt">登録する</a>
            </div>
        </section>
    </article>

    <section class="remodal" id="register-modal" data-remodal-id="register-modal"
             data-remodal-options="hashTracking:false">
        <h1>スタッフ登録</h1>

        <p>スタッフを登録しますか？</p>
        <a data-remodal-action="cancel" class="remodal-cancel">閉じる</a>
        <a data-remodal-action="cancel" class="remodal-confirm" id="register-bt">登録する</a>
    </section>
@endsection
