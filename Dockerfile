FROM php:7.4.2-apache
RUN apt-get update
RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get install msmtp ca-certificates curl -y
RUN sed -i -e "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf
RUN echo "LoadModule rewrite_module modules/mod_rewrite.so" >> /etc/apache2/apache2.conf
RUN a2enmod rewrite
ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/
RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && install-php-extensions gd
RUN service apache2 restart
COPY smtpsettings /smtpsettings
RUN mv /smtpsettings ~/.msmtprc
RUN chmod 600 ~/.msmtprc && cp -p ~/.msmtprc /etc/.msmtp_php && chown www-data:www-data /etc/.msmtp_php
RUN touch /var/log/msmtp.log && chown www-data:www-data /var/log/msmtp.log
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
RUN rm -rf /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini-production
RUN echo "sendmail_path = \"/usr/bin/msmtp -C /etc/.msmtp_php --logfile /var/log/msmtp.log -a karroch -t\"" >> /usr/local/etc/php/php.ini
#RUN chown -R www-data:www-data /var/www/html/img