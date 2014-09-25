#!/bin/bash

for a in {1..1000}
do
    echo "Testing host$a"
    curl -v "http://host$a/index.php" &
done
