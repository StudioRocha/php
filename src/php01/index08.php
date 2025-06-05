<?php

//[配列のルール]
// $people = array('Taro', 'Jiro', 'Saburo');


// //「var_dump」関数は、与えられた変数の値を詳細に出力します。 出力結果には、配列の要素数と各要素のデータ型、値、値の長さ（文字列の場合）が含まれます。 これにより、プログラムのデバッグに役立てることができます。
// var_dump($people);


//[連想配列とは？]

// $people = array(
//     'person1' => 'Taro',
//     'person2'  => 'Jiro',
//     'person3'  => 'Saburo'
//   );
  
//   var_dump($people);

//   [多次元配列]

// $people = [
//     [
//       "last_name" => "山田",
//       "first_name" => "太郎",
//       "age" => 29,
//       "gender" => "男性"
//     ],
//     [
//       "last_name" => "鈴木",
//       "first_name" => "次郎",
//       "age" => 25,
//       "gender" => "男性"
//     ],
//     [
//       "last_name" => "佐藤",
//       "first_name" => "花子",
//       "age" => 20,
//       "gender" => "女性"
//     ]
//   ];

//   echo $people[2]["last_name"] . $people[2]["first_name"];


//[foreach 文]

//for 文では繰り返す数をあらかじめ決めて処理を行いました。 while 文では、条件を指定し、その条件に合うあいだは処理が行われました。 foreach 文では、配列の要素の数だけ処理が繰り返し行われます。
// $people = array('Taro', 'Jiro', 'Saburo');

// foreach ($people as $person) {
//   echo $person;
//   echo '<br />';
// }


//添字が当て  連想配列と組み合わせ
// $people = array(
//     'person1' => 'Taro',
//     'person2'  => 'Jiro',
//     'person3'  => 'Saburo'
//   );
  
//   foreach ($people as $person => $name) {
//     echo $person . "は" . $name . "です" . '<br />';
//   }

  //Q

  
$people = [
    ['Taro', 25, 'men'],
    ['Jiro', 20, 'men'],
    ['hanako', 16, 'women']
  ];
  
  foreach ($people as $person) {
    echo $person[0] . '(' . $person[1] . '歳' . $person[2] . ')'. '<br />';
  }