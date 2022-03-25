from db_query.common import Common


class Category(Common):

    def __init__(self):
        Common.__init__(self)

    def get_id_by_name_en(self, name_en):
        """
        IDを取得
        :param name_en:
        :return:
        """

        result = self.db.table('category') \
            .select('id') \
            .where('name_en', name_en) \
            .first()

        return result['id']

    def get_list(self):
        """
        リストを取得
        :return:
        """

        return self.db.table('category').get()


