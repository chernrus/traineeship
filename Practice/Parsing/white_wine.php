<?php
  $re = '/<div class="grid__item small--one-half medium--one-half large--one-fifth">[\s\S]*?<p'.
  ' class="grid-link__title">\s*([\s\S]*?)\s*<\/p>[\S\s]*?<p'.
  ' class="grid-link__meta">\s*(£?.*)[\s\s]*<\/p>[\s\S]*?\/div>/';

  // '/<div class="grid__item small--one-half medium--one-half'.
  // ' large--one-fifth">[\s\S]*?<p class="grid-link__title">\s*([\s\S]*?)\s*<\/p>[\n\t\s]*<p'.
  // ' class="grid-link__meta">\s*(£?.*)[\n\s]*<\/p>[\s\S]*?\/div>/';

  $opt = array(
    'http' => array(
      'method' => 'GET',
      'proxy' => 'tcp://proxy:6666',
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
