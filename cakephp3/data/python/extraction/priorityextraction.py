import pandas as pd
import numpy as np
import numpy.matlib
from scipy.special import comb
import itertools

DEFAULT_USER_PRIORITY = 'congestion'
WEIGHTED_VECTOR = np.array([[1.0, 0], [0.9, 0.1], [0.8, 0.2], [0.7, 0.3], [0.6, 0.4]])

# l type: array
def normalize(l):
    l_min = min(l)
    l_max = max(l)
    return [(i - l_min) / (l_max - l_min) for i in l]

def nchoosek(vector, M):
    result = []
    for conb in itertools.combinations(vector, M):
        result.append(list(conb))
    
    return result

def UniformPoint(N,M):
    """
    % UniformPoint - Generate a set of uniformly distributed points on the unit hyperplane.
    %
    %   [W,N] = UniformPoint(N,M) returns approximately N uniformly distributed
    %   points with M objectives on the unit hyperplane.
    %
    %   Due to the requirement of uniform distribution, the number of points
    %   cannot be arbitrary, and the number of points in W may be slightly
    %   smaller than the predefined size N.
    %
    %   Example:
    %       [W,N] = UniformPoint(275,10)
    """

    H1 = 1;
    while comb(H1+M, M-1, exact=True) <= N:
        H1 = H1 + 1
    W = nchoosek(list(range(1,H1+M)),M-1) - np.matlib.repmat(list(range(M-1)), comb(H1+M-1,M-1,exact=True), 1) - 1
    W = np.squeeze(W)
    temp1 = np.stack([W, np.zeros(W.shape[0])], 1)+H1
    temp2 = np.stack([np.zeros(W.shape[0]),W], 1)
    W = (temp1-temp2)/H1
    if H1 < M:
        H2 = 0;
        while nchoosek(H1+M-1,M-1)+nchoosek(H2+M,M-1) <= N:
            H2 = H2 + 1
        if H2 > 0:
            W2 = nchoosek(list(range(1,H2+M)),M-1) - np.matlib.repmat(list(range(M-1)), comb(H2+M-1,M-1,exact=True), 1) - 1
            temp1 = np.stack([W2,np.zeros(W2.shape[0])], 1)+H2
            temp2 = np.stack([np.zeros(W2.shape[0]),W2], 1)
            W2 = (temp1-temp2)/H2
            W  = np.stack([W, W2/2+1/(2*M)], 0)
    N = W.shape[0]
    
    return W, N

def priorityextraction_main(nondominated_obj, user_priority=DEFAULT_USER_PRIORITY):
    if len(nondominated_obj) <= 3:
        return list(range(len(nondominated_obj))), nondominated_obj
    else:
        # 目的関数値の正規化
        if user_priority == 'distance':
            objvalue = np.stack([normalize(nondominated_obj['distance'].values), normalize(nondominated_obj['congestion'].values)], 1)
            objname = ['distance', 'congestion']
        elif user_priority == 'congestion':
            objvalue = np.stack([normalize(nondominated_obj['congestion'].values), normalize(nondominated_obj['distance'].values)], 1)
            objname = ['congestion', 'distance']
        elif user_priority == 'None':
            return nondominated_obj.sample(n=3)
        W, N = UniformPoint(100, 2)
        W[:,0] = W[:,0] - 1
        candidateW = W[50:,:]
        rank = np.zeros(len(objvalue))
        for i in range(len(candidateW)):
            scalarizing_value = np.dot(objvalue, candidateW[i])
            sort_index = np.argsort(scalarizing_value)[::-1]
            for j in range(len(sort_index)):
                rank[sort_index[j]] = rank[sort_index[j]] + j
        sort_rank = np.argsort(rank)[::-1]
        return sort_rank, nondominated_obj.iloc[sort_rank]

if __name__ == "__main__":
    # テスト用データファイル
    objfile = 'testdata/answer/ans_4obj.dat'
    objvalue = np.loadtxt(objfile, delimiter=', ')
    objname = ['col'+str(i) for i in range(1, objvalue.shape[1]+1)]
    objname[-2] = 'congestion'
    objname[-1] = 'distance'
    nondominated_obj = pd.DataFrame(-objvalue, columns=objname)
    priorityextraction_main(nondominated_obj)
