import numpy as np
import pandas as pd

# obj type: pandas.dataframe
# answer_index type: list
def onlineextraction_main(obj):
    # 目的関数値が全て1（ユーザーが希望する科と一致かつオンライン対応）のインデックスを計算
    allone_index = np.all(obj, axis=1).tolist()
    onlineextraction_index = allone_index
    # 全て1のデータがなければ，オンライン対応の病院を代わりにする
    if obj[allone_index].size == 0:
        possibleonline_index = obj['possible_online'].values
        onlineextraction_index = np.array(possibleonline_index, dtype=bool)
    
    return onlineextraction_index, obj[onlineextraction_index]
        

if __name__ == "__main__":
    # テスト用
    np.random.seed(1)
    testdata_value = np.random.randint(0, 2, (200, 2))
    testdata_name = np.empty(2, dtype=object)
    testdata_name = ['match_expert', 'possible_online']
    testdata = pd.DataFrame(testdata_value, columns=testdata_name)
    onlineextraction_obj = onlineextraction_main(testdata)
    