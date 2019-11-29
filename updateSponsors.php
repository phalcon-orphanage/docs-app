<?php

$data = file_get_contents(
    'https://raw.githubusercontent.com/phalcon/assets/master/phalcon/sponsors-fragment.html'
);

file_put_contents(
    '_includes/sponsors.html',
    $data
);
