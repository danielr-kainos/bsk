#!/bin/bash
 
#Required
domain=$1
commonname=$domain
 
#Change to your company details
country=GB
state=Nottingham
locality=Nottinghamshire
organization=Nothing Inc
organizationalunit=IT
email=administrator@nothing.net
 
if [ -z "$domain" ]
then
    echo "Argument not present."
    echo "Useage $0 [common name]"
 
    exit 99
fi

#Generate a key
echo "Generating key for $domain"
# openssl genrsa -des3 -passout pass:$password -out /tmp/some.key 2048 -noout
openssl genrsa -out /tmp/some.key 4096 -noout
 
#Create the request
echo "Creating CSR"
openssl req -new -key /tmp/some.key -out /tmp/some.csr -passin pass:$password \
    -subj "/C=$country/ST=$state/L=$locality/O=$organization/OU=$organizationalunit/CN=$commonname/emailAddress=$email"

#Create the certificate
echo "Creating CRT"
openssl x509 -req -days 7 \
    -in /tmp/some.csr \
    -signkey /tmp/some.key \
    -out /tmp/some.crt