<?php
class Book {
  public $title;
  public $page_size;

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

class DummyBook {
  public function getTitle() {
    return 'dummyTitle';
  }

  public function setTitle($value) {
    error_log("setTitle($value)");
  }

  public function getPageSize() {
    return -1;
  }

  public function setPageSize($value) {
    error_log("setPageSize($value)");
  }
}

$book = new DummyBook;
//$book = new Book('坊ちゃん', 123);

echo $book->getTitle() . "\n";
$book->setTitle('吾輩は猫である');
echo $book->getTitle() . "\n";
echo $book->getPageSize() . "\n";
$book->setPageSize(567);
echo $book->getPageSize() . "\n";
