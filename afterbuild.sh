#!/bin/bash

echo "Copying old files...."
cp -vr ./_static/3.*  _site/

echo "Combine sitemaps..."
cat _site/sitemap.xml  > ./temp.xml
sed -i -e 's/<\/urlset>/ /g' ./temp.xml

echo "Adding static sitemaps..."
cat _static/sitemap.txt >> ./temp.xml
echo "</urlset>"        >> ./temp.xml

echo "Copyinig compbined file..."
mv ./temp.xml ./_site/sitemap.xml

exit 0
