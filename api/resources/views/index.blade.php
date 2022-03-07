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
