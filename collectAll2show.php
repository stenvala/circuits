<?php

$str = '';

if ($handle = opendir('.')) {

  while (false !== ($entry = readdir($handle))) {

    if ($entry == 'all.tex' || $entry == 'show.tex'){
      continue;
    }

    if (strpos($entry, '.tex') !== false) {
      $str .= '\\begin{frame}{' . $entry . '}
\\begin{center}
\\input{' . $entry . '}
\\end{center}
\\end{frame}

';
    }
  }
}

file_put_contents('all.tex',$str);


//shell_exec('pdflatex show.tex show.pdf');

//die();

$commands = array(
'latex show.tex',
  'dvips show.dvi',
  'ps2pdf show.ps',
  'rm -rf show.dvi show.ps'
);

foreach ($commands as $com){
  print PHP_EOL . 'Execute: "' . $com . '"' . PHP_EOL;
  print shell_exec($com);
}

?>
