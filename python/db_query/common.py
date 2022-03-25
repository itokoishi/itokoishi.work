from orator import DatabaseManager
from django.conf import settings


class Common:

    def __init__(self):
        setting_db = settings.DATABASES['default']
        config = {
            'mysql': {
                'driver': 'mysql',
                'host': setting_db['HOST'],
                'database': setting_db['NAME'],
                'user': setting_db['USER'],
                'password': setting_db['PASSWORD'],
            }
        }

        self.db = DatabaseManager(config)

    def _insert(self, table_name, param):
        """
        DB登録
        """
        self.db.table(table_name).insert(param)

    def _insert_get_id(self, table_name, param):
        """
        DB登録後IDを取得
        """
        self.db.table(table_name).insert_get_id(param)

    def _update(self, table_name, primary_key, primary_val, param):
        """
        DB更新
        """
        self.db.table(table_name) \
            .where(primary_key, primary_val) \
            .update(param)

    def _delete(self, table_name, primary_key, primary_val):

        self.db.table(table_name)\
            .where(primary_key, primary_val)\
            .delete()
