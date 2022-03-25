from datetime import datetime


class Common:

    def __init__(self):
        self.items = {}

        # 年月日の取得 ----------------------------
        date = datetime.now()
        self.now_time = date.strftime('%Y-%m-%d %H:%M:%S')
        self.today = date.strftime('%Y-%m-%d')
        self.this_month = date.strftime('%Y-%m')
        self.this_year = date.strftime('%Y')
        self.time = date.strftime('%H')

    @classmethod
    def get_hour_choices(cls):
        """
        時間を取得
        """

        hour_choices = []
        append = hour_choices.append
        for hour in range(1, 24):
            hours = [format(hour, '0>2'), format(hour, '0>2')]
            append(hours)

        return tuple(hour_choices)

    @classmethod
    def get_minute_choices(cls):
        """
        分を取得
        """

        minute_choices = (
            ('00', '00'),
            ('15', '15'),
            ('30', '30'),
            ('45', '45')
        )

        return minute_choices

    def get_day_jp(self, week_no):
        """
        日本後の曜日を返す
        :param week_no:
        :return:
        """

        dic = {
            '1': '月',
            '2': '火',
            '3': '水',
            '4': '木',
            '5': '金',
            '6': '土',
            '0': '日',
        }

        return dic[week_no]

    @classmethod
    def get_schedule_hour_choices(cls):
        """
        スケジュールの時間を取得
        :return:
        """

        hour_choices = [format(hour, '0>2') for hour in range(0, 24)]

        return hour_choices

    @classmethod
    def get_schedule_minute_choices(cls):
        """
        スケジュールの分を取得
        """

        minute_choices = [format(minute, '0>2') for minute in range(0, 60)]

        return minute_choices
