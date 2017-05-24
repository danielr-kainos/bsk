#!/bin/bash

# Run database
su - postgres -c "/etc/init.d/postgresql start"
su - postgres -c "createdb bsk2017"
su - postgres -c "psql bsk2017 postgres --file=/tmp/sql/create.sql"
su - postgres -c "psql -U postgres -d postgres -c \"alter user postgres with password 'postgres';\""

# Run apache 
/etc/init.d/apache2 start
