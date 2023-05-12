<?php
function sumPageSize($books)
{
  $size = 0;
  foreach ($books as $book) {
    $size += $book['page_size'];
  }
  return $size;
}

function findBookByTitle($books, $title)
{
  foreach ($books as $book) {
    if ($book['title'] === $title) return $book;
  }
  return null;
}

$books = [];
array_push($books, ["title" => "坊ちゃん", "page_size" => 520]);
array_push($books, ["title" => "我輩は猫である", "page_size" => 454]);
array_push($books, ["title" => "こころ", "page_size" => 876]);

echo sumPageSize($books);
echo "\n";
print_r(findBookByTitle($books, "こころ"));
echo "\n";
