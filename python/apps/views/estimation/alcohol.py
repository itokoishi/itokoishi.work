from django.shortcuts import render
from django.http.response import HttpResponse
from django.views.generic import TemplateView
from lib.common import Common
from db_query.item import ShopType


class Index(Common, TemplateView):

    def __init__(self):
        Common.__init__(self)

    def get(self, request, *args, **kwargs):

        return render(request, 'admin/estimation/alcohol.html', self.items)
