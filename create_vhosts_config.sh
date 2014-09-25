#!/bin/bash

for a in {1..1000}
do
    echo "<VirtualHost host$a>
   DocumentRoot /var/www/hosts/host$a/docs
    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>" > "/etc/apache2/sites-enabled/hosts.$a.conf"

done
