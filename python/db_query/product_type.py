from db_query.common import Common


class ProductType(Common):

    def __init__(self):
        Common.__init__(self)

    def get_list_by_category_id(self, category_id):
        """
        商品タイプのリストをカテゴリで取得
        :param category_id:
        :return:
        """

        return self.db.table('product_type') \
            .where('category_id', category_id) \
            .get()

    def get_id_by_name_en(self, name_en):
        """
        IDを取得
        :param name_en:
        :return:
        """

        result = self.db.table('product_type') \
            .select('id') \
            .where('name_en', name_en) \
            .first()

        return result['id']
