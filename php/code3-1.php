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

// 本の情報を整形して出力できるクラス。extendsに続けて継承元のクラスの名前を書く。
class UIBook extends Book
{
  public function getDecoratedTitle()
  {
    return $this->getTitle() . "(" . $this->getPageSize() . ")";
  }
}

// 本の情報をJSONで出力できるクラス。extendsに続けて継承元のクラスの名前を書く。
class JsonableBook extends Book
{
  private $created_at;

  public function __construct($title, $page_size)
  {
    parent::__construct($title, $page_size);
    $this->created_at = new DateTime();
  }

  public function toJsonString()
  {
    return json_encode(
      [
        'title' => $this->getTitle(),
        'page_size' => $this->getPageSize(),
        'created_at' => $this->created_at->format('c')
      ],
      JSON_UNESCAPED_UNICODE
    );
  }
}

$uibook = new UIBook('test', 0); // Bookのコンストラクタが使えます
$uibook->setTitle('友情'); // Bookのメソッドが使えます
$uibook->setPageSize(489); // Bookのメソッドが使えます
echo $uibook->getDecoratedTitle(); // UIBookで作ったメソッドが使えます
echo "\n";

$jbook = new JsonableBook('みだれ髪', 290);
echo $jbook->getTitle(); // Bookのメソッドが使えます
echo "\n";
echo $jbook->toJsonString(); // JsonableBookで作ったメソッドが使えます
echo "\n";
