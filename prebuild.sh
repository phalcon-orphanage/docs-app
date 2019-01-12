#!/bin/bash

echo "Copying data files...."

cp -v ./4.0/en/meta-home.json                   ./_data/4-0-en-meta-home.json
cp -v ./4.0/en/meta-topics.json                 ./_data/4-0-en-meta-topics.json
cp -v ./4.0/en/meta-articles.json               ./_data/4-0-en-meta-articles.json

exit 0
