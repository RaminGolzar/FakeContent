<?php
/* include the library */
require __DIR__
        . DIRECTORY_SEPARATOR
        . 'FakeContent.php';

$fc = new FakeContent\FakeContent();

echo'<pre><b>';
print_r ($fc->field ('[###]'));
echo'</b></pre>';
