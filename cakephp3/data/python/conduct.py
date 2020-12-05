import sys
from mainextraction import mainextraction_main

DEFAULT_DATA_PATH = 'maindata/hospitaldata.csv'
DEFAULT_USER_POSITION = [0, 0]
DEFAULT_USER_DESIREDEXPERT = '内科'
DEFAULT_STATUS = '来院'
DEFAULT_USER_PRIORITY = '混雑度'

def decide_variables(args, path, user_position, user_desiredexpert, status, user_priority):
    for index, var in enumerate(args):
        if var == 'path':
            path = args[index+1]
        elif var == 'address_x':
            user_position[0] = float(args[index+1])
        elif var == 'address_y':
            user_position[1] = float(args[index+1])
        elif var == 'choice_expert':
            user_desiredexpert = args[index+1]
        elif var == 'online_or_visit':
            status = args[index+1]
        elif var == 'choice_priority':
            user_priority = args[index+1]
            
    return path, user_position, user_desiredexpert, status, user_priority

def change_name(status, user_priority):
    if status == 'オンライン':
        status = 'online'
        user_priority = 'None'
    elif status == '来院':
        status = 'offline'
        if user_priority == '混雑度':
            user_priority = 'congestion'
        elif user_priority == '距離':
            user_priority = 'distance'
    
    return status, user_priority

def conduct_main(args):
    path = DEFAULT_DATA_PATH
    user_position = DEFAULT_USER_POSITION
    user_desiredexpert = DEFAULT_USER_DESIREDEXPERT
    status = DEFAULT_STATUS
    user_priority = DEFAULT_USER_PRIORITY
    
    # コマンドライン引数から変数を読み込む
    path, user_position, user_desiredexpert, status, user_priority = decide_variables(args, path, user_position, user_desiredexpert, status, user_priority)
    # 名称の変更
    status, user_priority = change_name(status, user_priority)
    # 実行
    mainextraction_main(path, user_position, user_desiredexpert, status, user_priority)
    
    '''
    # 確認用
    print(path)
    print('ユーザーの現在位置: ',user_position)
    print('ユーザーが希望する科: ', user_desiredexpert)
    print('オンラインか対面か: ', status)
    print('ユーザーの嗜好: ', user_priority)
    '''

if __name__ == "__main__":
    args = sys.argv
    if 1 <= len(args):
        conduct_main(args)
    else:
        print('Arguments are too short')