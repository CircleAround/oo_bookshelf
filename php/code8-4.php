<?php
class Book
{
  protected $title;
  protected $page_size;

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
  protected $books;

  public function __construct()
  {
    $this->books = [];
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
  protected $max_size;

  public function __construct($max_size = 3)
  {
    parent::__construct();
    $this->max_size = $max_size;
  }

  public function canAddBook($book)
  {
    return count($this->books) < $this->max_size;
  }
}

class IndexedBookshelf
{
  protected $books;

  public function __construct()
  {
    $this->books = [];
  }

  public function addBook($book)
  {
    if (!$this->canAddBook($book)) return false;

    $this->books[$book->getTitle()] = $book;
    return true;
  }

  public function findBookByTitle($title)
  {
    return $this->books[$title] ?? null;
  }

  public function sumPageSize()
  {
    $size = 0;
    foreach ($this->books as $book) {
      $size += $book->getPageSize();
    }
    return $size;
  }

  public function canAddBook($book)
  {
    return true;
  }
}

function sample($bookshelf)
{
  $bookshelf->addBook(new Book("坊ちゃん", 520));
  $bookshelf->addBook(new Book("我輩は猫である", 454));
  $bookshelf->addBook(new Book("こころ", 876));

  if (!$bookshelf->addBook(new Book("門", 345))) {
    echo "新しい本を追加できませんでした。今の本の数: " . $bookshelf->size() . "\n";
  }

  var_dump($bookshelf->findBookByTitle("こころ"));
  echo $bookshelf->sumPageSize() . "\n";
}

sample(new Bookshelf);
sample(new LimitedBookshelf);
sample(new IndexedBookshelf);
