<?php
// 変更不可能な本
class ImmutableBook {
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
}

$book = new ImmutableBook("坊ちゃん", 520);

// プライベートプロパティなので、外部から直接アクセスできません。
// 無理にアクセスしようとするとエラーになります
// echo $book->title; // => Uncaught Error: Cannot access private property ImmutableBook::$title
// echo $book->page_size; // => Uncaught Error: Cannot access private property ImmutableBook::$page_size

// メソッドを通じてプライベートプロパティの値を取得できます。
echo $book->getTitle() . "\n";
echo $book->getPageSize() . "\n";

// ImmutableBookクラスは、インスタンス化した後、値を変更することができません。
// プログラムのバグは値の変更の結果起こることが殆どなので、セッターの無いImmutableBookは
// これまで扱ってきたBookよりも堅牢です。
