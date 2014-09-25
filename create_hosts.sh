#!/bin/bash

for a in {1..10000}
do
    mkdir -p "hosts/host$a/docs"
    mkdir -p "hosts/host$a/cgi-bin"
    echo "<?php echo \"site host$a\"; ?>" > "hosts/host$a/docs/index.php"

    echo "127.0.0.1 host$a" >> /etc/hosts
done
