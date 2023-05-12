<?php
class Book
{
  private $title;
  private $page_size;

  // インスタンス化時に使われるコンストラクタ
  public function __construct($title, $page_size)
  {
    $this->title = $title;
    $this->page_size = $page_size;
  }

  // 以下はクラス内の情報（プロパティや属性と呼ばれる）の操作

  // titleのゲッター
  public function getTitle()
  {
    return $this->title;
  }

  // titleのセッター
  public function setTitle($value)
  {
    $this->title = $value;
  }

  // pageSizeのゲッター
  public function getPageSize()
  {
    return $this->page_size;
  }

  // pageSizeのセッター
  public function setPageSize($value)
  {
    $this->page_size = $value;
  }
}

function findBookByTitle($books, $title)
{
  foreach ($books as $book) {
    if ($book->getTitle() === $title) return $book;
  }
  return null;
}

function sumPageSize($books)
{
  $size = 0;
  foreach ($books as $book) {
    $size += $book->getPageSize();
  }
  return $size;
}

$books = [];
$bocchan = new Book("坊ちゃん", 520); // クラスはnewで作成（インスタンス化）できる
array_push($books, $bocchan);

$nekoden = new Book("我輩は猫である", 0);
$nekoden->setPageSize(454); // セッターを使って値を設定することもできる
echo $nekoden->getPageSize(); // ゲッターを使って値を取り出せる
echo "\n";
array_push($books, $nekoden);

array_push($books, new Book("こころ", 876));

print_r(findBookByTitle($books, "こころ"));
echo "\n";
echo sumPageSize($books);
echo "\n";
