from django.shortcuts import render, redirect
from django.views.generic import TemplateView
from django.http.response import HttpResponse
from lib.common import Common
from db_query.news import News
from django.contrib import messages


class Index(Common, TemplateView):

    def get(self, request, *args, **kwargs):
        # -- ニュースリスト ---------------------
        news = News()
        news_list = news.get_news_list()

        # -- 表示用変数 ---------------------
        self.items['news_list'] = news_list

        return render(request, 'admin/news/list.html', self.items)


class Delete(Common, TemplateView):
    """
    削除処理
    """

    def post(self, request, *args, **kwargs):

        # -- ニュース削除 ---------------------
        news = News()
        news_id = request.POST.get('news_id')

        # -- ニュース削除 ---------------------
        news._delete('news', 'id', news_id)

        messages.success(request, 'ニュースを削除しました')
        return redirect('/admin/news/list')
