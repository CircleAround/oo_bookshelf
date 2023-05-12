<?php
class ImmutableBook
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

  public function getPageSize()
  {
    return $this->page_size;
  }

  public function toJsonString()
  {
    return json_encode(
      [
        "title" => $this->title,
        "page_size" => $this->page_size
      ],
      JSON_UNESCAPED_UNICODE
    );
  }
}

class Bookshelf
{
  private $books;

  public function __construct()
  {
    $this->books = [];
  }

  public function addBook($book)
  {
    $this->books[] = $book;
  }

  public function findBookByTitle($title)
  {
    foreach ($this->books as $book) {
      if ($book->getTitle() === $title) {
        return $book;
      }
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
}

$bookshelf = new Bookshelf;

$bookshelf->addBook(new ImmutableBook("坊ちゃん", 520));
$bookshelf->addBook(new ImmutableBook("我輩は猫である", 454));
$bookshelf->addBook(new ImmutableBook("こころ", 876));

echo $bookshelf->findBookByTitle("こころ")->toJsonString() . "\n";
echo $bookshelf->sumPageSize() . "\n";
