from django.shortcuts import render
from django.http.response import HttpResponse
from django.views.generic import TemplateView
from lib.common import Common
from db_query.item import ShopType


class Index(Common, TemplateView):

    def __init__(self):
        Common.__init__(self)

    def get(self, request, *args, **kwargs):

        return render(request, 'admin/estimation/apple.html', self.items)

    def post(self, request, *args, **kwargs):

        return HttpResponse('test')

    def param(self, request):
        """
        パラメータ
        :param request:
        :return:
        """

        return {
            'network_limits': request.POST.get('network_limits'),
            'remaining_charge': request.POST.get('remaining_charge'),
            'status': request.POST.get('status'),
            'bluetooth': request.POST.get('bluetooth'),
            'network': request.POST.get('network'),
            'speaker': request.POST.get('speaker'),
            'vibrator': request.POST.get('vibrator'),
            'call_function': request.POST.get('call_function'),
            'inner_camera': request.POST.get('inner_camera'),
            'outer_camera': request.POST.get('outer_camera'),
            'button': request.POST.get('button'),
            'touch_panel': request.POST.get('touch_panel'),
            'network_amount': request.POST.get('network_amount'),
            'touch_panel_position': request.POST.get('touch_panel_position'),
            'key_operation': request.POST.get('key_operation'),
            'battery': request.POST.get('battery'),
            'submerge': request.POST.get('submerge'),
            'scratch_mini': request.POST.get('scratch_mini'),
            'scratch_mini_position': request.POST.get('scratch_mini_position'),
            'scratch_middle': request.POST.get('scratch_middle'),
            'scratch_middle_position': request.POST.get('scratch_middle_position'),
            'scratch_big': request.POST.get('scratch_big'),
            'scratch_big_position': request.POST.get('scratch_big_position'),
            'liquid_crystal_scratch': request.POST.get('liquid_crystal_scratch'),
            'liquid_crystal_crack': request.POST.get('liquid_crystal_crack'),
            'color_unevenness': request.POST.get('color_unevenness'),
            'liquid_crystal_leak': request.POST.get('liquid_crystal_leak'),
            'liquid_crystal_float': request.POST.get('liquid_crystal_float'),
        }
