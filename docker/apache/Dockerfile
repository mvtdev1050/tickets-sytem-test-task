# docker/apache/Dockerfile
FROM httpd:2.4.51
COPY backend.apache.conf /usr/local/apache2/conf/backend.apache.conf
RUN echo "Include /usr/local/apache2/conf/backend.apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf
RUN echo "LoadModule rewrite_module modules/mod_rewrite.so" \
    >> /usr/local/apache2/conf/httpd.conf
