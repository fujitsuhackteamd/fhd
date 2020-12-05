import pandas as pd
import sys
import numpy as np
from calculation.calculateobj import distance_from_hospital
from calculation.calculateobj import congestion
from calculation.calculateobj import desiredexpert_check
from calculation.calculateobj import possibleonline_check

# デフォルトのユーザー現在位置
DEFAULT_USER_POSITION = np.zeros(2)
# デフォルトのユーザー希望専門
DEFAULT_USER_DESIRED_EXPERT = "内科"

# オフラインにおける目的関数値を計算
# pandasdata type: pandas.DataFrame
# user_position type: ndarray
# user_desiredexpert type: string
def calculate_offlineobj_main(pandasdata, user_position, user_desiredexpert):
    objvalue = np.zeros((len(pandasdata), 3))
    objname = np.empty(3, dtype=object)
    objvalue[:,0], objname[0] = distance_from_hospital(pandasdata, user_position)
    objvalue[:,1], objname[1] = congestion(pandasdata)
    objvalue[:,2], objname[2] = desiredexpert_check(pandasdata, user_desiredexpert)
    
    
    obj = pd.DataFrame(objvalue, columns=objname)
    
    return obj
    

# オンラインにおける目的関数値を計算
def calculate_onlineobj_main(pandasdata, user_desiredexpert):
    objvalue = np.zeros((len(pandasdata), 2))
    objname = np.empty(2, dtype=object)
    objvalue[:,0], objname[0] = desiredexpert_check(pandasdata, user_desiredexpert)
    objvalue[:,1], objname[1] = possibleonline_check(pandasdata)
    
    obj = pd.DataFrame(objvalue, columns=objname)
    
    return obj


def decideobj_main(pandasdata, user_position=DEFAULT_USER_POSITION, user_desiredexpert=DEFAULT_USER_DESIRED_EXPERT, status="offline"):
    if status == 'offline':
        obj = calculate_offlineobj_main(pandasdata, user_position, user_desiredexpert)
    elif status == 'online':
        obj = calculate_onlineobj_main(pandasdata, user_desiredexpert)
    else:
        print('Error: Status {0} does not exist. Only online or offline are available.'.format(status), file=sys.stderr)
        sys.exit(1)
        
    return obj


if __name__ == "__main__":
    # テスト用データファイル
    csvfile = 'hospitaldata.csv'
    hospitaldata = pd.read_csv(csvfile)
    obj = decideobj_main(hospitaldata, 'offline')