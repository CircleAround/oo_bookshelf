<?php
echo "staticプロパティのサンプル\n";

class Test {
  public static $count = 0;

  public static function increment() {
    return self::$count += 1;
  }
}

echo Test::$count; // [クラス名]::[変数名] で利用できる（インスタンス化不要）
echo "\n";
echo Test::increment();
echo "\n";

echo "グローバル変数のサンプル\n";

$global_value = 1;

function changeglobal_value() {
  global $global_value;
  $global_value += 1;
  echo "global_valueの数: " . $global_value . "\n";
}

class Test3 {
  public function changeglobal_value() {
    global $global_value;
    $global_value += 10;
    echo "global_valueの数: " . $global_value . "\n";
  }
}

changeglobal_value(); // global_valueの数: 2
changeglobal_value(); // global_valueの数: 3
$test3 = new Test3;
$test3->changeglobal_value(); // global_valueの数: 13
?>
