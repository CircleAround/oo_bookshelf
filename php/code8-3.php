<?php
class Book {
  protected $title;
  protected $page_size;

  public function __construct($title, $page_size) {
    $this->title = $title;
    $this->page_size = $page_size;
  }

  public function getTitle() {
    return $this->title;
  }

  public function setTitle($value) {
    $this->title = $value;
  }

  public function getPageSize() {
    return $this->page_size;
  }

  public function setPageSize($value) {
    $this->page_size = $value;
  }
}

function findBookByTitle($books, $title) {
  foreach ($books as $book) {
    if ($book->getTitle() === $title) return $book;
  }
  return null;
}

function sumPageSize($books) {
  $size = 0;
  foreach ($books as $book) {
    $size += $book->getPageSize();
  }
  return $size;
}

// メソッドを呼ぶと細かいログを出してくれるBook
class DebugBook extends Book {
  public function getTitle() {
    error_log("getTitle(): " . parent::getTitle());
    return parent::getTitle();
  }

  public function setTitle($value) {
    error_log("setTitle({$value})");
    parent::setTitle($value);
  }

  public function getPageSize() {
    error_log("getPageSize(): " . parent::getPageSize());
    return parent::getPageSize();
  }

  public function setPageSize($value) {
    error_log("setPageSize({$value})");
    parent::setPageSize($value);
  }
}

// 環境変数を利用してインスタンス化するクラスを変えるメソッド
function createBook($title, $page_size) {
  if(getenv('DEBUG') == 'true') {
    // 開発中はデバッグ用のログが出るクラスをインスタンス化
    return new DebugBook($title, $page_size);
  } else {
    // 本番稼働中はログが出ないクラスをインスタンス化
    return new Book($title, $page_size);
  }
}

$books = [];
$bocchan = createBook("坊ちゃん", 520);
array_push($books, $bocchan);

$nekoden = createBook("我輩は猫である", 0);
$nekoden->setPageSize(454);
echo $nekoden->getPageSize() . "\n";
array_push($books, $nekoden);

array_push($books, createBook("こころ", 876));

var_dump(findBookByTitle($books, "こころ"));
echo sumPageSize($books) . "\n";

// -- 出力のサンプル --
// -- 開発時 --
// $ DEBUG=true php code8-3.php
// setPageSize(454)
// getPageSize(): 454
// 454
// getTitle(): 坊ちゃん
// getTitle(): 我輩は猫である
// getTitle(): こころ
// object(DebugBook)#3 (2) {
//   ["title":protected]=>
//   string(9) "こころ"
//   ["page_size":protected]=>
//   int(876)
// }
// getPageSize(): 520
// getPageSize(): 454
// getPageSize(): 876
// 1850

// -- 本番稼働時 --
// $ php code8-3.php
// 454
// object(Book)#3 (2) {
//   ["title":protected]=>
//   string(9) "こころ"
//   ["page_size":protected]=>
//   int(876)
// }
// 1850