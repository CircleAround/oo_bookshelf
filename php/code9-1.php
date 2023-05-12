<?php

class Book {
  private $title;
  private $page_size;

  public function __construct($title, $page_size) {
    $this->title = $title;
    $this->page_size = $page_size;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getPageSize() {
    return $this->page_size;
  }

  public function toArray() {
    return ['title' => $this->title, 'page_size' => $this->page_size];
  }
}

interface BookshelfInterface {
  public function canAddBook($book);
  public function addBook($book);
  public function findBookByTitle($title);
  public function sumPageSize();
  public function size();
}

class Bookshelf implements BookshelfInterface{
  private $books;

  public function __construct() {
    $this->books = [];
  }

  public function addBook($book) {
    if (!$this->canAddBook($book)) return false;

    array_push($this->books, $book);
    return true;
  }

  public function findBookByTitle($title) {
    foreach ($this->books as $book) {
      if ($book->getTitle() === $title) return $book;
    }
    return null;
  }

  public function sumPageSize() {
    $size = 0;
    foreach ($this->books as $book) {
      $size += $book->getPageSize();
    }
    return $size;
  }

  public function size() {
    return count($this->books);
  }

  public function canAddBook($book) {
    return true;
  }
}

class LimitedBookshelfDecorator implements BookshelfInterface {
  private $bookshelf;
  private $max_size;

  public function __construct($bookshelf, $max_size = 3) {
    $this->bookshelf = $bookshelf;
    $this->max_size = $max_size;
  }

  public function canAddBook($book) {
    return $this->size() < $this->max_size;
  }

  public function addBook($book) {
    if (!$this->canAddBook($book)) return false;
    return $this->bookshelf->addBook($book);
  }

  public function findBookByTitle($title) {
    return $this->bookshelf->findBookByTitle($title);
  }

  public function sumPageSize() {
    return $this->bookshelf->sumPageSize();
  }

  public function size() {
    return $this->bookshelf->size();
  }
}

class DebugBookshelfDecorator implements BookshelfInterface {
  private $bookshelf;

  public function __construct($bookshelf) {
    $this->bookshelf = $bookshelf;
  }

  public function canAddBook($book) {
    error_log("- canAddBook(" . json_encode($book->toArray()) . ")");
    return $this->bookshelf->canAddBook($book);
  }

  public function addBook($book) {
    error_log("- addBook(" . json_encode($book->toArray()) . ")");
    return $this->bookshelf->addBook($book);
  }

  public function findBookByTitle($title) {
    error_log("- findBookByTitle(" . $title . ")");
    return $this->bookshelf->findBookByTitle($title);
  }

  public function sumPageSize() {
    error_log("- sumPageSize()");
    return $this->bookshelf->sumPageSize();
  }

  public function size() {
    error_log("- size()");
    return $this->bookshelf->size();
  }
}

// 通常のBookshelfを作成し、それにLimitedのデコレートを行う
$bookshelf = new LimitedBookshelfDecorator(new Bookshelf, 3);

$bookshelf->addBook(new Book("坊ちゃん", 520));
$bookshelf->addBook(new Book("我輩は猫である", 454));
$bookshelf->addBook(new Book("こころ", 876));

// 途中でさらにデコレートしてデバッグを有効にもできる。
$bookshelf = new DebugBookshelfDecorator($bookshelf);

if (!$bookshelf->addBook(new Book("門", 345))) {
  echo("新しい本を追加できませんでした。今の本の数: " . $bookshelf->size());
  echo "\n";
}

echo(json_encode($bookshelf->findBookByTitle("こころ")->toArray()));
echo "\n";
echo($bookshelf->sumPageSize());
echo "\n";