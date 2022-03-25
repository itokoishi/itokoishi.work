from django.shortcuts import render
from django.http.response import HttpResponse
from django.views.generic import TemplateView


class Index(Common, TemplateView):

    def __init__(self):
        Common.__init__(self)

    def get(self, request, *args, **kwargs):
            
        # -- ショップタイプ ---------------------
        shop_type = ShopType()
        shop_list = shop_type.get_type_list()

        # -- 店舗情報 ---------------------
        self.items['shop_list'] = shop_list
        return render(request, 'admin/estimation/index.html', self.items)
