from db_query.common import Common


class News(Common):

    def __init__(self):
        Common.__init__(self)

    def get_news_list(self):
        """
        ニュースリスト
        """

        return self.db.table('news AS n') \
            .select(self.db.raw('n.*, st.name AS shop_type_name')) \
            .left_join('shop_type AS st', 'n.shop_type_id', '=', 'st.id') \
            .order_by('n.register_time', 'DESC') \
            .get()

    def get_news_data(self, news_id):
        """
        ニュース情報
        """

        return self.db.table('news') \
            .where('id', news_id) \
            .first()
