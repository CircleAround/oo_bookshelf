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

  public function toArray()
  {
    return [
      "title" => $this->title,
      "page_size" => $this->page_size
    ];
  }
}

// 説明のために用意した配列のような操作ができるクラス
class ArrayList
{
  private $items;

  public function push($item)
  {
    $this->items[] = $item;
  }

  public function clear()
  {
    $this->items = [];
  }

  public function toJsonString()
  {
    // 保持している$itemをJSONに整形しています
    return json_encode(
      array_map(function ($item) {
        return $item->toArray();
      }, $this->items),
      JSON_UNESCAPED_UNICODE
    );
  }
}

class Bookshelf
{
  private $books;

  public function __construct($books)
  {
    $this->books = $books;
  }

  public function addBook($book)
  {
    $this->books->push($book);
  }

  public function getBooks()
  {
    return $this->books;
  }
}

$books = new ArrayList();
$bookshelf = new Bookshelf($books);

$bookshelf->addBook(new ImmutableBook("坊ちゃん", 520));
$bookshelf->addBook(new ImmutableBook("我輩は猫である", 454));
$bookshelf->addBook(new ImmutableBook("こころ", 876));

// こんな変更ができてしまいます。
// 1. Bookshelfに渡した$booksを直接操作
$books->push(new ImmutableBook("門", 345)); // $bookshelfに関係ないところで勝手に追加
echo $bookshelf->getBooks()->toJsonString() . "\n";

// 2. Bookshelfから取り出したbooksを直接操作
$innnerBooks = $bookshelf->getBooks(); // インスタンスの取り出し
$innnerBooks->clear(); // $bookshelfに関係ないところで勝手に消す

echo $bookshelf->getBooks()->toJsonString() . "\n";
