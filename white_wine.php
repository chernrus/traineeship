<?php
  $re = '/<p\sclass="grid-link__title">\s*([\s\S]*?)\s*<\/p>[\n\t\s]*<p\sclass="grid-link__meta">\s*(£?.*)[\n\s]*<\/p>/';

  $opt = array(
    'http' => array(
      'proxy' => 'tcp://proxy:6666',
      'request_fulluri' => true,
    ),
  );

  $context = stream_context_create($opt);
  $str = file_get_contents('https://shop.hopburnsblack.co.uk/collections/white-wine', false, $context);

  preg_match_all($re, $str, $matches);
  array_shift($matches);

  $table1 = fopen('file1.csv', 'w');
  $table2 = fopen('file2.csv', 'w');

  for($i = 0, $n = count($matches[0]); $i < $n; $i++) {
    fputcsv($table1, array($matches[0][$i], $matches[1][$i]));
  }

  $arr = array_combine($matches[0], $matches[1]);

  foreach ($arr as $key=>$value) {
      fputcsv($table2, array($key,$value));
  }
?>
