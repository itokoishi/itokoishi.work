from django.urls import path, re_path
from .views.market_price import Index as MarketPriceIndex


urlpatterns = [
    path('', MarketPriceIndex.as_view()),
]
