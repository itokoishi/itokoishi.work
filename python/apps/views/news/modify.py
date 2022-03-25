from django.shortcuts import render, redirect
from django.views.generic import TemplateView
from django.http.response import HttpResponse
from lib.common import Common
from db_query.news import News
from admin.forms.news_form import NewsForm
from django.contrib import messages


class Index(Common, TemplateView):

    def get(self, request, *args, **kwargs):
        """
        更新ページ
        """

        # -- ニュース情報 ---------------------
        news_id = kwargs['id']
        news = News()
        news_data = news.get_news_data(news_id)

        # -- フォーム ---------------------
        form = NewsForm(initial=self.get_initial(news_data))

        # -- 表示用変数 ---------------------
        self.items['news_data'] = news_data
        self.items['form'] = form
        self.items['news_id'] = news_id
        return render(request, 'admin/news/modify.html', self.items)

    def post(self, request, *args, **kwargs):
        """
        更新実行
        """

        # -- フォーム ---------------------
        form = NewsForm(request.POST)

        # -- バリデーション ---------------------
        if not form.is_valid():
            self.items['form'] = form
            return render(request, 'admin/news/modify.html', self.items)

        # -------------------------------------
        # 更新処理
        # -------------------------------------
        news = News()
        param = self.get_param(request)
        shop_id = request.POST.get('shop_id')

        news._update('news', 'id', shop_id, param)

        # -- 更新完了 ---------------------
        messages.success(request, 'ニュースの更新が完了しました')
        return redirect('/admin/news/list')

    def get_param(self, request):
        """
        パラメータを返す
        """

        return {
            'shop_type_id': request.POST.get('shop_type'),
            'title': request.POST.get('title'),
            'message': request.POST.get('message'),
            'register_time': self.now_time,
            'modify_time': self.now_time
        }

    def get_initial(self, news_data):
        """
        フォームデフォルト値
        """

        return {
            'shop_type': news_data.shop_type_id,
            'title': news_data.title,
            'message': news_data.message,
        }
