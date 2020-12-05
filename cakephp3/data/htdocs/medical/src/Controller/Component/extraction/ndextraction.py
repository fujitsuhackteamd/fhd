import numpy as np
import pandas as pd

# 非劣解を取り出す（高速実装が面倒なのでライブラリからコピー）
def nondominated(costs, return_mask = True):
    """
    Find the pareto-efficient points
    :param costs: An (n_points, n_costs) array
    :param return_mask: True to return a mask
    :return: An array of indices of pareto-efficient points.
        If return_mask is True, this will be an (n_points, ) boolean array
        Otherwise it will be a (n_efficient_points, ) integer array of indices.
    """
    is_efficient = np.arange(costs.shape[0])
    n_points = costs.shape[0]
    next_point_index = 0  # Next index in the is_efficient array to search for
    while next_point_index<len(costs):
        nondominated_point_mask = np.any(costs<costs[next_point_index], axis=1)
        nondominated_point_mask[next_point_index] = True
        is_efficient = is_efficient[nondominated_point_mask]  # Remove dominated points
        costs = costs[nondominated_point_mask]
        next_point_index = np.sum(nondominated_point_mask[:next_point_index])+1
    if return_mask:
        is_efficient_mask = np.zeros(n_points, dtype = bool)
        is_efficient_mask[is_efficient] = True
        return is_efficient_mask
    else:
        return is_efficient


# 非劣解，及び元データにおける非劣解インデックスを返す(最小化問題を仮定)
# ユーザーが希望する科が一致するという条件の基，できるだけ距離が近い/混雑度が近い病院を取り出す
# 希望する科が一致する病院が最初から存在しなければ，それ抜きで考える．
# obj type: pandas.dataframe
def ndextract_main(obj):
    objvalue = obj.values
    # 希望する科が一致する病院のインデックスを取り出す
    if 'match_expert' in obj.columns:
        match_expert_index = np.array(obj['match_expert'].values.tolist(), dtype=bool)
    else:
        match_expert_index = np.ones(len(objvalue), dtype=bool)
    
    # 希望する科が一致する病院の中で非劣解をとりだす
    if np.any(match_expert_index):
        nondominated_index = nondominated(objvalue[match_expert_index]).tolist()
        i = 0
        for index, bool_value in enumerate(match_expert_index):
            if bool_value:
                if not nondominated_index[i]:
                    match_expert_index[index] = not match_expert_index[index]
                i = i + 1
        nondominated_index = match_expert_index
    else:
        print('No hospital matching users desired expert.')
        nondominated_index = nondominated(objvalue).tolist()
    
    return nondominated_index, obj[nondominated_index]


if __name__ == "__main__":
    # テスト用データファイル
    objfile = 'testdata/dtlz1Rand_4obj.dat'
    objvalue = np.loadtxt(objfile, delimiter=', ')
    objname = ['col'+str(i) for i in range(1, objvalue.shape[1]+1)]
    obj = pd.DataFrame(-objvalue, columns=objname)
    nondominated_index, nondominated_solutions = ndextract_main(obj)
    print(objvalue[nondominated_index,:])
    