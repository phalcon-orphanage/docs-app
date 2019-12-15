<?php

$base      = "/opt/build/repo/";
//$base      = __DIR__ . '/'; // local

echo "Updating JSON" . PHP_EOL;
$languages = array_filter(glob($base . '4.0/*'), 'is_dir');

$languages = array_map(
    function ($element) use ($base) {
        return str_replace($base . "4.0/", "", $element);
    },
    $languages
);

foreach ($languages as $language) {
    $source = $base . '4.0/' . $language . '/meta-home.json';
    $target = $base . '_data/4-0-' . $language . '-meta-home.json';
    copy($source, $target);
    echo '.';
    $source = $base . '4.0/' . $language . '/meta-topics.json';
    $target = $base . '_data/4-0-' . $language . '-meta-topics.json';
    copy($source, $target);
    echo '.';
}

echo PHP_EOL;
echo "Updating Sponsors" . PHP_EOL;

$data = file_get_contents(
    'https://raw.githubusercontent.com/phalcon/assets/master/phalcon/sponsors-fragment.html'
);

file_put_contents(
    $base . '_includes/sponsors.html',
    $data
);

echo "Updating Fan Art" . PHP_EOL;

$data = file_get_contents(
    'https://raw.githubusercontent.com/phalcon/assets/master/phalcon/fanart-fragment.html'
);

file_put_contents(
    $base . '_includes/fanart.html',
    $data
);

echo "Updating Footer" . PHP_EOL;

$data = file_get_contents(
    'https://raw.githubusercontent.com/phalcon/assets/master/phalcon/footer-fragment.html'
);

file_put_contents(
    $base . '_includes/footer.html',
    $data
);
