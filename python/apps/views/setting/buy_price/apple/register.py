from django.shortcuts import render, redirect
from django.views.generic import TemplateView
from django.http.response import HttpResponse
from lib.common import Common
from admin.forms.buy_apple_form import BuyAppleForm
from db_query.category import Category
from db_query.product_type import ProductType
from db_query.apple_buy_price import AppleBuyPrice
from django.contrib import messages


class Index(Common, TemplateView):

    def __init__(self):
        Common.__init__(self)
        self.category = Category()
        self.product_type = ProductType()
        self.apple_buy_price = AppleBuyPrice()

    def get(self, request, *args, **kwargs):
        """
        登録ページ
        :param request:
        :param args:
        :param kwargs:
        :return:
        """

        # -- フォーム取得 ---------------------
        category_name_en = kwargs['category']
        product_type_name_en = kwargs['product_type']
        form = BuyAppleForm()

        # -- カテゴリ ---------------------
        category_id = self.category.get_id_by_name_en(category_name_en)

        # -- 商品タイプ ---------------------
        product_type_list = self.product_type.get_list_by_category_id(category_id)
        product_type_id = self.product_type.get_id_by_name_en(product_type_name_en)

        # -- 表示用変数 ---------------------
        self.items['product_type_list'] = product_type_list
        self.items['product_type'] = product_type_name_en
        self.items['category_id'] = category_id
        self.items['product_type_id'] = product_type_id
        self.items['form'] = form

        return render(request, 'admin/setting/buy-price/apple/register.html', self.items)

    def post(self, request, *args, **kwargs):
        """
        登録処理
        :param request:
        :param args:
        :param kwargs:
        :return:
        """

        # -- フォーム取得 ---------------------
        category_name_en = kwargs['category']
        product_type_name_en = kwargs['product_type']
        form = BuyAppleForm(request.POST)

        # -- カテゴリ ---------------------
        category_id = self.category.get_id_by_name_en(category_name_en)

        # -- 商品タイプ ---------------------
        product_type_list = self.product_type.get_list_by_category_id(category_id)
        product_type_id = self.product_type.get_id_by_name_en(product_type_name_en)
        if not form.is_valid():
            self.items['product_type_list'] = product_type_list
            self.items['product_type'] = product_type_name_en
            self.items['category_id'] = category_id
            self.items['product_type_id'] = product_type_id
            self.items['form'] = form
            return render(request, 'admin/setting/buy-price/apple/register.html', self.items)

        # -- 登録処理 ---------------------
        param = self.get_param(request, category_id, product_type_id)
        return HttpResponse(param)

        self.apple_buy_price._insert('apple_buy_price', param)

        messages.success(request, '買取商品の登録が完了しました')
        return redirect('/admin/setting/buy-price/apple/list')


    def get_param(self, request, category_id, product_type_id):
        """
        登録用パラメータ
        :param request:
        :param category_id:
        :param product_type_id:
        :return:
        """

        s_model_no = request.POST.get('model_no' + ' ', '')
        s_name = request.POST.get('name' + ' ', '')
        s_generation = request.POST.get('generation' + '世代 ', '')
        s_size_extension = request.POST.get('size_extension')
        s_size = request.POST.get('size' + s_size_extension + ' ', '')
        s_memory = request.POST.get('memory' + 'GB ', '')
        s_cpu = request.POST.get('cpu' + ' ', '')
        s_frequency_band = request.POST.get('frequency_band' + 'GHz ', '')
        s_storage_type = request.POST.get('storage_type' + ' ', '')
        s_storage_capacity = request.POST.get('storage_capacity' + 'GB ', '')
        s_keyboard_array = request.POST.get('keyboard_array' + ' ', '')
        sim_free = request.POST.get('sim_free', '')
        if not sim_free or sim_free != 'キャリア':
            s_sim_free = ''
        else:
            s_sim_free = sim_free + ' '
        s_color = request.POST.get('color' + ' ', '')

        search_text = s_model_no + s_name + s_generation + s_size + s_memory + \
                      s_cpu + s_frequency_band + s_storage_type + s_storage_capacity + \
                      s_sim_free + s_color + s_keyboard_array

        return {
            'category_id': category_id,
            'product_type_id': product_type_id,
            'model_no': request.POST.get('model_no'),
            'name': request.POST.get('name'),
            'generation': request.POST.get('generation'),
            'size': request.POST.get('size'),
            'memory': request.POST.get('memory'),
            'cpu': request.POST.get('cpu'),
            'frequency_band': request.POST.get('frequency_band'),
            'storage_type':  request.POST.get('storage_type'),
            'storage_capacity': request.POST.get('storage_capacity'),
            'keyboard_array': request.POST.get('keyboard_array'),
            'sim_free': request.POST.get('sim_free'),
            'color': request.POST.get('color'),
            'search_text': search_text,
            'register_time': self.now_time,
            'modify_time': self.now_time,
        }
