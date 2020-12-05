import pandas as pd
from calculation.decideobj import decideobj_main
import random
from extraction.ndextraction import ndextract_main
from extraction.onlineextraction import onlineextraction_main
from extraction.priorityextraction import priorityextraction_main

def decide_user_information():
    # 乱数シード値の指定
    random.seed(1)
    # 乱数により，ユーザーの現在位置を決定
    user_position = [random.randint(1,1000) for _ in range(2)]
    # 乱数により，ユーザーの希望する科を決定
    expert_variations = ['内科', '外科', '耳鼻科', '眼科']
    user_desiredexpert = random.choice(expert_variations)
    
    return user_position, user_desiredexpert


# userfile type: string (file path)
# テスト用ユーザーファイルの読み込み関数（index行のユーザーデータを取得）
def read_userdata_from_csv(userfile, index):
    userdata = pd.read_csv(userfile ,encoding='shift-jis')
    user_position = [userdata.at[index, 'address_x'], userdata.at[index, 'address_y']]
    user_desiredexpert = userdata.at[index, 'choice_expert']
    status = userdata.at[index, 'online_or_visit']
    # 呼び名の修正
    if status == 'オンライン':
        status = 'online'
        user_priority = 'None'
    elif status == '来院':
        status = 'offline'
        user_priority = userdata.at[index, 'choice_priority']
        if user_priority == '混雑度':
            user_priority = 'congestion'
        elif user_priority == '距離':
            user_priority = 'distance'
    
    return user_position, user_desiredexpert, status, user_priority

# csvfile type: string (file path)
def mainextraction_main(csvfile, user_position, user_desiredexpert, status='offline', user_priority='None'):
    # pandas型としてcsvfileを読み込み
    hospitaldata = pd.read_csv(csvfile, encoding='shift-jis')
    # csvfileから目的関数値を計算（オフラインかオンラインかで変更）
    # obj type: pandas.dataframe
    obj = decideobj_main(hospitaldata, user_position, user_desiredexpert, status)
    
    # 最適解集合をデータフレームに保存する
    if status == 'offline':
        # 非劣解（とインデックス）を取り出し
        nondominated_index, nondominated_solutions = ndextract_main(obj)
        # 非劣解から，ユーザーの嗜好に合わせて解を絞る
        sorted_rank, sorted_solutions = priorityextraction_main(nondominated_solutions, user_priority)
        # 上位3つを取り出し
        ansdata = hospitaldata[nondominated_index]
        # データフレームの保存
        if len(sorted_rank) > 3:
            ansdata.iloc[sorted_rank][:3].to_csv('extractdata/nd_hospitaldata.csv', index=False, encoding='utf-8')
        else:
            ansdata.to_csv('extractdata/nd_hospitaldata.csv', index=False, encoding='utf-8')
    elif status == 'online':
        onlineextraction_index, onlineextraction_solutions = onlineextraction_main(obj)
        # データフレームの保存
        hospitaldata[onlineextraction_index].to_csv('extractdata/nd_hospitaldata.csv', index=False, encoding='utf-8')
    

if __name__ == "__main__":
    # テスト用データファイル
    hospitalfile = 'testdata/hospitaldata.csv'
    userfile = 'testdata/userdata.csv'
    userdata = pd.read_csv(userfile ,encoding='SHIFT-JIS')
    user_position, user_desiredexpert, status, user_priority = read_userdata_from_csv(userfile, 2)
    print('ユーザーの現在位置: ',user_position)
    print('ユーザーが希望する科: ', user_desiredexpert)
    print('オンラインか対面か: ', status)
    print('ユーザーの嗜好: ', user_priority)
    '''
    # ユーザー情報(ユーザーの現在位置と希望する科)を乱数により決定
    user_position, user_desiredexpert = decide_user_information() 
    status = 'offline'
    '''
    mainextraction_main(hospitalfile, user_position, user_desiredexpert, status, user_priority)