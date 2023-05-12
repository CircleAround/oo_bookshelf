<?php
function findBookByTitle($books, $title)
{
  foreach ($books as $book) {
    if ($book['title'] === $title) return $book;
  }
  return null;
}

function sumPageSize($books)
{
  $size = 0;
  foreach ($books as $book) {
    $size += $book['page_size'];
  }
  return $size;
}

function createBook($title, $page_size)
{
  return ['title' => $title, 'page_size' => $page_size];
}

$books = [];
array_push($books, createBook("坊ちゃん", 520));
array_push($books, createBook("我輩は猫である", 454));
array_push($books, createBook("こころ", 876));

$books[0]['pageSize'] = 521; // 本当は page_size を増やしたかったのに間違ってもなかなか気づけない

echo sumPageSize($books);
echo "\n";
print_r(findBookByTitle($books, "こころ"));
echo "\n";
