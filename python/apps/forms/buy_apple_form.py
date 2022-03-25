from django import forms
from db_query.item import ShopType


class BuyAppleForm(forms.Form):
    """
    ニュース用のフォーム
    """

    # -- 型番 ---------------------
    model_no = forms.CharField(
        required=False,
        widget=forms.TextInput(
            attrs={'class': 'form-control w250'}
        )
    )

    # -- 品名 ---------------------
    name = forms.CharField(
        label='品名',
        required=True,
        widget=forms.TextInput(
            attrs={'class': 'form-control w500'}
        )
    )

    # -- 世代 ---------------------
    generation = forms.CharField(
        required=False,
        widget=forms.TextInput(
            attrs={'class': 'form-control w100'}
        )
    )

    # -- サイズ ---------------------
    size = forms.CharField(
        required=False,
        widget=forms.TextInput(
            attrs={'class': 'form-control w100'}
        )
    )

    # -- メモリー ---------------------
    memory = forms.CharField(
        required=False,
        widget=forms.TextInput(
            attrs={'class': 'form-control w100'}
        )
    )

    # -- cpu ---------------------
    cpu = forms.ChoiceField(
        required=False,
        choices=(
            ('CORE i3', 'CORE i3'),
            ('CORE i5', 'CORE i5'),
            ('CORE i7', 'CORE i7'),
            ('CORE M', 'CORE M'),
            ('CORE m3', 'CORE m3'),
            ('CORE m5', 'CORE m5'),
            ('CORE m7', 'CORE m7'),
        ),
        widget=forms.Select(
            attrs={'class': 'form-control w100'}
        )
    )

    # -- ストレージ容量 ---------------------
    frequency_band = forms.CharField(
        required=False,
        widget=forms.TextInput(
            attrs={'class': 'form-control w100'}
        )
    )

    # -- ストレージタイプ ---------------------
    storage_type = forms.ChoiceField(
        required=False,
        choices=(
            ('HDD', 'HDD'),
            ('SSD', 'SSD')
        ),
        widget=forms.Select(
            attrs={'class': 'form-control w100'}
        )
    )

    # -- ストレージ容量 ---------------------
    storage_capacity = forms.CharField(
        required=False,
        widget=forms.TextInput(
            attrs={'class': 'form-control w100'}
        )
    )

    # -- キー配列 ---------------------
    keyboard_array = forms.ChoiceField(
        required=False,
        choices=(
            ('JIS配列', 'JIS配列'),
            ('US配列', 'US配列'),
            ('UK配列', 'UK配列'),
            ('中国語配列', '中国語配列'),
            ('韓国語配列', '韓国語配列')
        ),
        widget=forms.Select(
            attrs={'class': 'form-control w100'}
        )
    )

    # -- sim_free ---------------------
    sim_free = forms.ChoiceField(
        required=False,
        choices=(
            ('キャリア', 'キャリア'),
            ('SIMフリー', 'SIMフリー'),
            ('WIFIのみ', 'WIFIのみ'),
        ),
        widget=forms.Select(
            attrs={'class': 'form-control w150'}
        )
    )

    # -- 色 ---------------------
    color = forms.CharField(
        required=False,
        widget=forms.TextInput(
            attrs={'class': 'form-control w250'}
        )
    )
