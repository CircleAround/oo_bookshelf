<?php
class Book {
  private $title; // private にしているので、クラスの外から呼ぶことはできない
  private $page_size;

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

$nekoden = new Book("我輩は猫である", 0);

// 以下の2つはエラーになります。アクセスできません。
//echo $nekoden->title; // => PHP Fatal error:  Uncaught Error: Cannot access private property Book::$title
//echo $nekoden->page_size; // => PHP Fatal error:  Uncaught Error: Cannot access private property Book::$page_size

$nekoden->setPageSize(454);
echo $nekoden->getTitle() . "\n";
echo $nekoden->getPageSize() . "\n";
