FROM httpd:alpine

RUN sed -i '/LoadModule rewrite_module/s/^#//g' /usr/local/apache2/conf/httpd.conf \
    &&  sed -i '/LoadModule proxy_module/s/^#//g' /usr/local/apache2/conf/httpd.conf \
    &&  sed -i '/LoadModule proxy_fcgi_module/s/^#//g' /usr/local/apache2/conf/httpd.conf \
    &&  sed -i '/Include conf\/extra\/httpd-vhosts/s/^#//g' /usr/local/apache2/conf/httpd.conf

EXPOSE 80