<?php
// 関数
function sumNumbers($numbers) { // $numbersは引数。関数の外から値を渡せる
  $size = 0; // 変数として $sizeを定義して0で初期化
  // $numbersの中身を順番に取り出して$sizeに加算
  foreach($numbers as $number) {
    $size += $number;
  }

  return $size; // 戻り値
}

// 配列を指す変数を定義
$numbers = []; // 変数として $numbers を定義して空の配列で初期化
array_push($numbers, 520); // 配列のarray_push関数を使って520を配列に追加
array_push($numbers, 454);
array_push($numbers, 876);

// 関数を呼び出して結果（戻り値の内容）をechoで表示
echo sumNumbers($numbers);
echo "\n";

// 新たな値を追加します
array_push($numbers, 11);
// 関数は何度も同じ処理を再利用できるように名前と処理を関連づけたものです
echo sumNumbers($numbers);
echo "\n";
