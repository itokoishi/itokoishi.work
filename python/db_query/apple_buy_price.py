from db_query.common import Common


class AppleBuyPrice(Common):

    def __init__(self):
        Common.__init__(self)

    def get_list(self, category_id, product_type_id):
        """
        リストを取得
        :param category_id:
        :param product_type_id:
        :return:
        """

        return self.db.table('apple_buy_price').select() \
            .where('category_id', category_id) \
            .where('product_type_id', product_type_id) \
            .get()
