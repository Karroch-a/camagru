#bin/bash
a2enmod ssl
a2ensite default-ssl
apache2ctl configtest
service apache2 restart
