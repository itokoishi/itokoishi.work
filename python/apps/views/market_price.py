from django.shortcuts import render
from django.http.response import HttpResponse
from django.views.generic import TemplateView
from ..lib.common import Common
import requests
import urllib.parse
from bs4 import BeautifulSoup
import re
import math


class Index(TemplateView, Common):

    def __init__(self):
        Common.__init__(self)

    def get(self, request, *args, **kwargs):
        price_count = 0
        price_sum = 0
        search_content = []

        # -------------------------------------
        # 商品検索
        # -------------------------------------
        search_text = request.GET.get('search_text', '')
        exclusion_text = request.GET.get('exclusion_text', '')

        if not search_text:
            self.items = {
                'search_text': search_text,
                'exclusion_text': exclusion_text
            }
            return render(request, 'apps/market-price.html', self.items)

        param = '?va=' + urllib.parse.quote(search_text) + '&vo=&ve=ジャンク ' + exclusion_text + '&auccat=0&aucminprice=&aucmaxprice=&thumb=1&slider=0&ei=UTF-8&f_adv=1&fr=auc_adv&&n=100'
        target_url = 'https://auctions.yahoo.co.jp/closedsearch/closedsearch' + param
        html = requests.get(target_url)
        scraping = BeautifulSoup(html.content, "html.parser")
        product = scraping.select("li.Product")

        # -------------------------------------
        # 相場データ作成
        # -------------------------------------
        append = search_content.append
        for val in product:
            dic = {}
            p = re.compile(r"<[^>]*?>")

            # -- ジャンクの文言がある場合はスキップ ---------------------
            title_html = val.select_one('h3.Product__title')
            price_html = val.select_one('span.Product__priceValue')
            if 'ジャンク' in title_html:
                continue

            # -- 価格 ---------------------
            price_html = str(price_html)
            str_price = p.sub("", price_html)
            price_num = re.sub(r"\D", "", str_price)
            price_sum = price_sum + int(price_num)
            price_count = price_count + 1

            image_html = val.select('img.Product__imageData')
            for e in image_html:
                image_url = e['src']

            dic['title'] = p.sub("", str(title_html))
            dic['price'] = str_price
            dic['image'] = image_url
            append(dic)

        if price_count == 0:
            self.items = {
                'search_text': search_text,
                'exclusion_text': exclusion_text
            }
            return render(request, 'apps/market-price.html', self.items)

        # -------------------------------------
        # 商品の金額取得
        # -------------------------------------

        # -- 平均金額 ---------------------
        price_average = price_sum / price_count

        # -- ヤフオク手数料 ---------------------
        fee = price_average * 0.08

        # -- 買取価格 ---------------------
        s_buy_price = price_average - fee
        a_buy_price = s_buy_price - (s_buy_price * 0.1)
        b_buy_price = s_buy_price - (s_buy_price * 0.2)
        c_buy_price = s_buy_price - (s_buy_price * 0.3)

        # -- カンマ区切り ---------------------
        price_average = "{:,}".format(math.floor(price_average))
        fee = "{:,}".format(math.floor(fee))
        s_buy_price = "{:,}".format(math.floor(s_buy_price))
        a_buy_price = "{:,}".format(math.floor(a_buy_price))
        b_buy_price = "{:,}".format(math.floor(b_buy_price))
        c_buy_price = "{:,}".format(math.floor(c_buy_price))

        self.items = {
            'price_average': price_average,
            'fee': fee,
            's_buy_price': s_buy_price,
            'a_buy_price': a_buy_price,
            'b_buy_price': b_buy_price,
            'c_buy_price': c_buy_price,
            'search_content': search_content,
            'search_text': search_text,
            'exclusion_text': exclusion_text
        }

        return render(request, 'apps/market-price.html', self.items)
