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

// 本棚として本を格納するクラスの基底クラス
class Bookshelf
{
  protected $books = []; // 子クラスで呼べるように protected

  public function addBook($book)
  {
    // 自分自身（this）のcanAddBookメソッドを呼び出す
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

  // 「今この本を追加できますか？」というチェックを行えるメソッド
  public function canAddBook($book)
  {
    return true; // デフォルトでは何も制限を行わないのでどんな時も本を追加できる
  }
}

// 格納できる本の数が指定できる本棚クラス
class LimitedBookshelf extends Bookshelf
{
  private $max_size;

  public function __construct($max_size = 3)
  {
    $this->max_size = $max_size;
  }

  // 親クラスが作っているメソッドを上書き（オーバーライド）できます。
  public function canAddBook($book)
  {
    return count($this->books) < $this->max_size;
  }
}

$bookshelf = new LimitedBookshelf;

$bookshelf->addBook(new Book("坊ちゃん", 520));
$bookshelf->addBook(new Book("我輩は猫である", 454));
$bookshelf->addBook(new Book("こころ", 876));

if (!$bookshelf->addBook(new Book("門", 345))) {
  echo "新しい本を追加できませんでした。今の本の数: " . $bookshelf->size() . "\n";
}

print_r($bookshelf->findBookByTitle("こころ"));
echo $bookshelf->sumPageSize();
echo "\n";

class FixedPageBook extends Book {
  public function __construct($title) {
    parent::__construct($title, 10); // 必ず10ページで本が作られます
  }
}

$fixed_page_book = new FixedPageBook('10ページ');
echo $fixed_page_book->getPageSize();
echo "\n";
