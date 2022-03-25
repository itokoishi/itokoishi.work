from db_query.common import Common


class ShopType(Common):
    """
    ショップのタイプ
    """

    def __init__(self):
        Common.__init__(self)

    def get_form_item(self):
        """
        フォームアイテム
        """

        result = self.db.table('shop_type').get()

        array = [(0, '全てのショップ項目')]
        append = array.append
        for row in result:
            tup = (row['id'], row['name'])
            append(tup)

        return tuple(array)

    def get_type_list(self):
        """
        タイプリスト
        """
        return self.db.table('shop_type').get()

    def get_type(self, shop_type_id):
        """
        タイプを表示
        :param shop_type_id:
        :return:
        """
        return self.db.table('shop_type') \
            .where('id', shop_type_id) \
            .where('view_flag', 1) \
            .first()
