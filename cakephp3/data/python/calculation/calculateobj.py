import pandas as pd
import numpy as np

# 目的関数値と目的の名称を返すことに注意

# ユーザーと病院間の距離を計算
# pandasdata type: pandas.DataFrame
# user_position type: ndarray
def distance_from_hospital(pandasdata, user_position):
    hospital_position = np.stack([pandasdata["address_x"].values, pandasdata["address_y"].values], 1)
    distance = np.zeros(len(hospital_position))
    for i in range(len(hospital_position)):
       distance[i] = np.linalg.norm(user_position-hospital_position[i,:])
    
    return distance, 'distance'


# 病院の混雑度を返す
def congestion(pandasdata):
    return pandasdata["congestion"].values, 'congestion'


# ユーザーが希望する専門科であるかどうかを返す．一致していれば1，してなければ0を返す．
# user_desiredexpert type: string
def desiredexpert_check(pandasdata, user_desiredexpert):
    hospital_expert = pandasdata["expert"].values
    expert_check = np.zeros(len(hospital_expert))
    for i in range(len(hospital_expert)):
        if user_desiredexpert == hospital_expert[i]:
            expert_check[i] = 1
    
    return expert_check, 'match_expert'


# オンライン対応ができる病院かどうかを返す．対応できれば1，できなければ0を返す．
def possibleonline_check(pandasdata):
    return pandasdata["possible"].values, 'possible_online'


if __name__ == "__main__":
    # テスト用データファイル
    csvfile = 'hospitaldata.csv'
    pandasdata = pd.read_csv(csvfile)
    hospital_position = np.stack([pandasdata["address_x"].values, pandasdata["address_y"].values], 1)
    user_position = np.zeros(2)
    obj, objname = distance_from_hospital(user_position, hospital_position)
    print(obj)