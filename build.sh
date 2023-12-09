# !/bin/bash

git submodule update --remote --merge && \
wget -O /opt/buildhome/repo/_includes/sponsors.html https://raw.githubusercontent.com/phalcon/assets/master/phalcon/sponsors-fragment.html && \
wget -O /opt/buildhome/repo/_includes/fanart.html https://raw.githubusercontent.com/phalcon/assets/master/phalcon/fanart-fragment.html && \
wget -O /opt/buildhome/repo/_includes/footer.html https://raw.githubusercontent.com/phalcon/assets/master/phalcon/footer-fragment.html & \
jekyll build --incremental && \
cp _redirects _site/_redirects
