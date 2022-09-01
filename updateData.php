<?php

//$base      = __DIR__ . '/'; // local
$base      = "/opt/build/repo/";
$comments = 'https://api.github.com/repos/phalcon/cphalcon/issues/14608/comments?page=';


echo "Updating JSON" . PHP_EOL;
$versions = ['4.0', '5.0'];

foreach ($versions as $version) {
    echo "Version " . $version . PHP_EOL;
    $languages = array_filter(glob($base . $version . '/*'), 'is_dir');

    $languages = array_map(
        function ($element) use ($base, $version) {
            return str_replace($base . $version . '/', '', $element);
        },
        $languages
    );

    foreach ($languages as $language) {
        $source = $base . $version . '/' . $language . '/meta-home.json';
        $target = $base . $version . '_data/' . $version . '-' . $language . '-meta-home.json';
        copy($source, $target);
        echo '.';

        if ('4.0' === $version) {
            $source = $base . '4-0/' . $language . '/meta-topics.json';
        } else {
            $source = $base
                . str_replace('.', '-', $version) . '/'
                . $language . '/meta-topics-5.json'
            ;
        }

        $target = $base . '_data/' . $version . '-' . $language . '-meta-topics.json';
        copy($source, $target);
        echo '.';
    }
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

echo "Getting NFR Reactions" . PHP_EOL;

$result = [];
for ($i = 1; $i < 6; $i++) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $comments . $i);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Phalcon Agent');
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        [
            'Accept: application/vnd.github.squirrel-girl-preview+json'
        ]
    );

    $content = curl_exec($ch);
    curl_close($ch);

    echo "Got content " . $i . PHP_EOL;
    $data = json_decode($content, true);

    foreach ($data as $comment) {
        if (isset($comment['id'])) {
            $id = $comment['id'];
        } else {
            $id = '';
        }
        if (isset($comment['html_url'])) {
            $url = $comment['html_url'];
        } else {
            $url = '';
        }
        if (isset($comment['body'])) {
            $body = $comment['body'];
        } else {
            $body = '';
        }
        if (isset($comment['reactions'])) {
            $reactions = $comment['reactions'];
        } else {
            $reactions = [];
        }
        if (isset($reactions['+1'])) {
            $plusone = $reactions['+1'];
        } else {
            $plusone = 0;
        }
        $body = explode(PHP_EOL, $body);
        $body = str_replace(["\r", "\r\n"], "", $body[0]);

        $plusone = substr("00" . $plusone, -3);
        $result[$plusone . '-' . $id] = [
            'reaction' => $plusone,
            'body'     => "[" . $body . "](" . $url . ")",
        ];
    }
}

echo "Sorting Results" . PHP_EOL;

krsort($result);

echo "Creating Content" . PHP_EOL;

$output = "| Votes  | Description             |" . PHP_EOL;
$output .=  "|--------|-------------------------|" . PHP_EOL;
foreach ($result as $item) {
    $output .=  '| ' . $item['reaction'] . ' | ' . $item['body'] . ' |' . PHP_EOL;
}

$output .= PHP_EOL;

foreach ($versions as $version) {
    foreach (glob($base . $version . '/*', GLOB_ONLYDIR) as $language) {
        echo "Processing language " . $language . ' ' . $version . PHP_EOL;
        $fileName = $language . '/new-feature-request-list.md';
        $existing = file_get_contents($fileName);
        $existing .= PHP_EOL . PHP_EOL . $output;
        file_put_contents($fileName, $existing);
    }
}
