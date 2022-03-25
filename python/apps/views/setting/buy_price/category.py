from django.shortcuts import render, redirect
from django.views.generic import TemplateView
from django.http.response import HttpResponse
from lib.common import Common
from db_query.category import Category


class Index(Common, TemplateView):

    def get(self, request, *args, **kwargs):
        category = Category()
        category_list = category.get_list()

        # -- 表示用変数 ---------------------
        self.items['category_list'] = category_list
        return render(request, 'admin/setting/buy-price/category.html', self.items)
