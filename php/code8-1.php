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

class UIBook extends Book
{
  public function getDecoratedTitle()
  {
    return "{$this->title}({$this->page_size})";
  }
}

class JsonableBook extends Book
{
  protected $created_at;

  public function __construct($title, $page_size)
  {
    parent::__construct($title, $page_size);
    $this->created_at = date("Y-m-d H:i:s");
  }

  public function toJsonString()
  {
    return json_encode(["title" => $this->title, "page_size" => $this->page_size, "created_at" => $this->created_at], JSON_UNESCAPED_UNICODE);
  }
}

$books = [];

$uibook = new UIBook('友情', 489);
array_push($books, $uibook);

$jbook = new JsonableBook('みだれ髪', 290);
array_push($books, $jbook);

$csv_data = [];
array_push($csv_data, ['タイトル', 'ページ数', '拡張情報']);

foreach ($books as $book) {
  $record = [$book->getTitle(), $book->getPageSize()];

  // 以下のif文は煩雑。できれば無くしてしまいたい。
  if ($book instanceof UIBook) {
    array_push($record, $book->getDecoratedTitle());
  }
  if ($book instanceof JsonableBook) {
    array_push($record, $book->toJsonString());
  }

  array_push($csv_data, $record);
}

print_r($csv_data);
