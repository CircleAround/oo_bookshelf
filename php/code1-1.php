<?php
// 関数
function sumPageSize($books) {
  $size = 0;
  foreach($books as $book) {
    // 取り出した連想配列からpage_sizeを取得して加算
    $size += $book['page_size'];
  }
  return $size;
}

$books = [];
// 連想配列で情報の塊を配列に格納
array_push($books, ["title" => "坊ちゃん", "page_size" => 520]);
array_push($books, ["title" => "我輩は猫である", "page_size" => 454]);
array_push($books, ["title" => "こころ", "page_size" => 876]);

echo sumPageSize($books);
echo "\n";
