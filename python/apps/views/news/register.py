from django.shortcuts import render, redirect
from django.views.generic import TemplateView
from django.contrib import messages
from lib.common import Common
from admin.forms.news_form import NewsForm
from db_query.news import News
from django.http.response import HttpResponse


class Index(Common, TemplateView):

    def get(self, request, *args, **kwargs):
        """
        登録フォーム
        """

        # -------------------------------------
        # フォーム
        # -------------------------------------
        form = NewsForm()

        # -------------------------------------
        # 表示用
        # -------------------------------------
        self.items['form'] = form

        return render(request, 'admin/news/register.html', self.items)

    def post(self, request, *args, **kwargs):
        """
        ニュース登録実行
        """

        # -------------------------------------
        # フォーム
        # -------------------------------------
        form = NewsForm(request.POST)

        # -------------------------------------
        # バリデーション
        # -------------------------------------
        if not form.is_valid():
            self.items['form'] = form
            return render(request, 'admin/news/register.html', self.items)
        
        # -------------------------------------
        # 登録処理
        # -------------------------------------
        news = News()
        param = self.get_param(request)
        news._insert('news', param)

        messages.success(request, 'ニュースの登録が完了しました')
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