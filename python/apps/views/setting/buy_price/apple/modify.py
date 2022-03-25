from django.shortcuts import render, redirect
from django.views.generic import TemplateView
from django.http.response import HttpResponse
from lib.common import Common


class Index(Common, TemplateView):

    def get(self, request, *args, **kwargs):
        return render(request, 'admin/setting/buy-price/apple/modify.html', self.items)
