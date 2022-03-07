@extends('layouts.front-main')

@section('page-css')
    <link rel="stylesheet" href="/css/style.css">
@endsection

@section('page-js')
    <script>
        $(function () {

            $('input[name="date"]').datepicker({
                format: 'yyyy-mm-dd',
                language: 'ja'
            });

            $(document).on('click', '#search-bt', function(){
                $('#search-form').submit();
                return false;
            });

            $(document).on('click', '.complete-bt', function(){
                let name = $(this).data('name');
                let id = $(this).data('id');

                $('#complete-modal').find('.modal-text span').text(name);
                $('#complete-modal').find('input[name="id"]').val(id);
                $('#complete-modal').find('input[name="name"]').val(name);
                $('#complete-modal').remodal().open();
                return false;
            });

            $(document).on('click', '#search-open-close', () => {
                if ($('#search-item').is(':hidden')) {
                    $('#search-item').show();
                    $('#search-box h1').attr('style', 'margin:0 0 20px 0; padding:0 0 5px 0; border-bottom: 1px solid #dddddd;')
                    $(this).text('[閉じる]').removeClass('close');
                } else {
                    $('#search-item').hide();
                    $('#search-box h1').attr('style', 'margin:0; padding:0; border: none')
                    $(this).text('[開く]').addClass('close');
                }
                return false;
            });

        });
    </script>
@endsection

@section('main-contents')
    <article>
        <h1>トップページ</h1>
        <section>

        </section>
    </article>
@endsection
