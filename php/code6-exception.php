<?php
class Book
{
  private $title;
  private $page_size;

  public function __construct($title, $page_size)
  {
    // 想定外の引数で呼び出された場合には例外を投げる。
    if ($title === null) {
      throw new Exception('titleはnullではいけません');
    }
    if ($page_size === null) {
      throw new Exception('page_sizeはnullではいけません');
    }

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

try {
  $book = new Book('こころ', null); // この呼び出しは例外が投げられます。
  $book->setPageSize(100); // 例外が投げられるので、この行には到達しません。
} catch (Exception $e) { 
  // 例外が投げられた後ここに処理が続きます。
  echo $e->getMessage() . "\n";
}

// 例外をcatchした後、続きのコードが実行されます。

function createBook($title, $page_size)
{
  return new Book($title, $page_size);
}

try {
  // createBookの new Bookで 例外が発生した後、関数をどんどん巻き戻して try を探します。
  $book = createBook(null, 234);
} catch (Exception $e) {
  // new Book -> createBook と巻き戻り、tryを見つけてここに入ってきます。
  $book = new Book('ダミーブック', 0);  //例外の場合に別の処理を用意することもできます。
}

// 例外をcatchした後、続きのコードが実行されます。
print_r($book);
