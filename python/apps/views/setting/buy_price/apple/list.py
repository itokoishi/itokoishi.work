from django.shortcuts import render, redirect
from django.views.generic import TemplateView
from django.http.response import HttpResponse
from lib.common import Common
from db_query.apple_buy_price import AppleBuyPrice
from db_query.category import Category


class Index(Common, TemplateView):

    def get(self, request, *args, **kwargs):

        apple_buy_price = AppleBuyPrice()
        category = Category()

        # -- リスト取得 ---------------------
        category_name_en = kwargs['category']
        category_id = category.get_id_by_name_en(category_name_en)
        product_type_id = request.GET.get('product_type_id', 1)
        product_list = apple_buy_price.get_list(category_id, product_type_id)

        # -- 表示用変数 ---------------------
        self.items['category_name_en'] = category_name_en
        self.items['product_list'] = product_list

        return render(request, 'admin/setting/buy-price/' + category_name_en + '/list.html', self.items)
