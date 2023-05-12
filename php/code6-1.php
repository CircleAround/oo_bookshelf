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

class Bookshelf
{
  protected $books = [];

  public static function valueOf($book_arrays)
  {
    // クラスがBookshelfの場合には new Bookshelfで動作
    // クラスがLimitedBookshelfの場合には new LimitedBookshelfで動作
    $bookshelf = new static;

    foreach ($book_arrays as $book_array) {
      $book = new Book($book_array['title'], $book_array['page_size']);
      $bookshelf->addBook($book);
    }

    return $bookshelf;
  }

  public function addBook($book)
  {
    if (!$this->canAddBook($book)) return false;

    array_push($this->books, $book);
    return true;
  }

  public function findBookByTitle($title)
  {
    foreach ($this->books as $book) {
      if ($book->getTitle() === $title) return $book;
    }

    return null;
  }

  public function sumPageSize()
  {
    $size = 0;

    foreach ($this->books as $book) {
      $size += $book->getPageSize();
    }

    return $size;
  }

  public function size()
  {
    return count($this->books);
  }

  public function canAddBook($book)
  {
    return true;
  }
}

class LimitedBookshelf extends Bookshelf
{
  private $max_size;

  public function __construct($max_size = 3)
  {
    $this->max_size = $max_size;
  }

  public function canAddBook($book)
  {
    return count($this->books) < $this->max_size;
  }
}

// 本棚に最初から入れたい本の情報
$books = [
  ["title" => "坊ちゃん", "page_size" => 520],
  ["title" => "我輩は猫である", "page_size" => 454],
  ["title" => "こころ", "page_size" => 876]
];

// valueOfはBookshelfで定義していますが、派生クラスのLimitedBookshelfでも使えます
$bookshelf = LimitedBookshelf::valueOf($books);

if (!$bookshelf->addBook(new Book("門", 345))) {
  echo "新しい本を追加できませんでした。今の本の数: " . $bookshelf->size() . "\n";
}

echo $bookshelf->findBookByTitle("こころ")->getTitle() . "\n";
echo $bookshelf->sumPageSize() . "\n";
