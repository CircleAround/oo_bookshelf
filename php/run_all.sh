#!/bin/bash
for file in ./code*.php; do
  echo "=== {$file}を実行します =========="
  php $file
  echo "=== {$file}を実行しました =========="
done