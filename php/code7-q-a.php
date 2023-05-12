<?php
class Counter {
  public $value;

  public function __construct() {
    $this->value = 0;
  }
}

$counter = new Counter; // 数値をカウントアップするクラス
$counter->value = $counter->value + 1; //ここでcounterの値を一つ増やしたい
echo $counter->value . "\n";
$counter->value = $counter->value + 1; //ここでcounterの値を一つ増やしたい
echo $counter->value . "\n";
?>
