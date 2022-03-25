from django import forms
from db_query.item import ShopType


class NewsForm(forms.Form):
    """
    ニュース用のフォーム
    """

    # -- ショップタイプ ---------------------
    shop_type_db = ShopType()

    shop_type = forms.ChoiceField(
        required=True,
        choices=shop_type_db.get_form_item(),
        widget=forms.Select(
            attrs={'class': 'form-control w500'}
        )
    )

    # -- タイトル ---------------------
    title = forms.CharField(
        required=True,
        widget=forms.TextInput(
            attrs={'class': 'form-control w500'}
        )
    )

    # -- メッセージ ---------------------
    message = forms.CharField(
        required=True,
        widget=forms.Textarea(
            attrs={'class': 'form-control w500'}
        )
    )
