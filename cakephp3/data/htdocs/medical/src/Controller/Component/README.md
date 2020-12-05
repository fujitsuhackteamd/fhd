# extract_hospital
病院取り出しpythonコード

## 1. 実行について  
conduct.py をコンソール上で動かすことで実行できます．実行後の病院データは，'maindata/nd_hospitaldata.csv' で出力されます．  
また，nd_hospitaldata.csvの形式は，秋元さんが作ってくださったファイルの形式と同様となっています．  
  - 実行形式
  ~~~
  python conduct.py 引数  
  ~~~

## 2. 引数について  
引数は以下の6つあります．  
### 引数リスト
#### 1. path (deault: maindata/hospitaldata.csv)  
実行に必要な，全病院データが格納されているhosipitaldata.csvのパスです (ファイル形式は，秋元さんが作ってくださった形式と同様）．  
#### 2. address_x (default: 0)  
患者の現在位置(経度)です．  
#### 3. address_y (default: 0)  
患者の現在位置(緯度)です．  
#### 4. choice_expert (default: 内科)  
患者が希望する科です．入力は，[内科, 外科, 耳鼻科, 眼科]のうち何れかにしてください．  
#### 5. online_or_visit (default: 来院)  
オンラインか，来院かの情報です．入力は，[来院, オンライン]のうち何れかにしてください．  
#### 6. choice_priority (default: 混雑度)  
患者が希望する選好条件です．入力は，[距離, 混雑度]のうち何れかにしてください．

## 3. 実行例
基本的には，[引数の名称, その引数の値]をセットにしてコマンドラインに与えます．例えば address_x に50を入れたい場合は，address_x 50 と，連番引数として与えます．  
もし，コマンドラインにて入力されていない引数があれば，代わりにdefault値が入力されます．  
### - path=maindata/data.csv, address_x=100, address_y=100, choice_expert=外科, online_or_visit=オンライン, choice_priority=距離の場合  
~~~
python conduct.py path maindata/hospitaldata.csv address_x 100 address_y 100 choice_expert 外科 online_or_visit オンライン choice_priority 距離 
~~~
### - path='default', address_x=200, address_y='default', choice_expert=耳鼻科, online_or_visit='default', choice_priority=混雑度の場合  
~~~
python conduct.py address_x 200 choice_expert 耳鼻科 choice_priority 混雑度 
~~~

## 4. 出力されるファイルについて  
1に記載の通り，取り出された病院データは 'maindata/nd_hospitaldata.csv' で出力されます．  
また，online_or_visit の値に従って取り出される病院が異なります．
### online_or_visit=来院の場合  
患者が希望する科 (choice_expert) が一致するという条件の基，できるだけ距離が近い，かつ，混雑度が小さい病院を取り出しています．  
さらに choice_priority によって病院を3つまで絞っています．  
### online_or_visit=オンラインの場合  
患者が希望する科 (choice_expert) が一致するという条件の基，オンライン対応している病院のみを取り出しています．
