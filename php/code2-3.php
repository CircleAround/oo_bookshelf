<?php
class Book
{
  private $title;
  private $page_size;

  public function __construct($title, $page_size)
  {
    $this->title = $title;
    $this->page_size = $page_size;
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function setTitle($value)
  {
    $this->title = $value;
  }

  public function getPageSize()
  {
    return $this->page_size;
  }

  public function setPageSize($value)
  {
    $this->page_size = $value;
  }
}

// 本棚として本を格納するクラスの基底クラス
class Bookshelf
{
  private $books; // この $booksは privateなので Bookshelfのインスタンスからしか操作できない

  public function __construct()
  {
    $this->books = [];
  }

  // 新しく本を追加する
  public function addBook($book)
  {
    array_push($this->books, $book);
  }

  // タイトルを指定して本を取得する
  public function findBookByTitle($title)
  {
    foreach ($this->books as $book) {
      if ($book->getTitle() === $title) return $book;
    }
    return null;
  }

  // ページ数を全部合計する
  public function sumPageSize()
  {
    $size = 0;
    foreach ($this->books as $book) {
      $size += $book->getPageSize();
    }
    return $size;
  }
}

$bookshelf = new Bookshelf;

$bookshelf->addBook(new Book("坊ちゃん", 520));
$bookshelf->addBook(new Book("我輩は猫である", 454));
$bookshelf->addBook(new Book("こころ", 876));

print_r($bookshelf->findBookByTitle("こころ"));
echo "\n";
echo $bookshelf->sumPageSize();
echo "\n";
