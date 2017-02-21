<?php
    $re = '/<p\sclass="grid-link__title">\s*([\s\S]*?)\s*<\/p>[\n\t\s]*<p\sclass="grid-link__meta">\s*(£?.*)[\n\s]*<\/p>/';
$str = file_get_contents('https://shop.hopburnsblack.co.uk/collections/white-wine');

preg_match_all($re, $str, $matches);

$fp = fopen('file.csv', 'w');

for($i = 0, $n = count($matches[1]); $i < $n; $i++) {
  fputcsv($fp, array($matches[1][$i],$matches[2][$i]));
}
?>
