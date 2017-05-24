#! /bin/bash

echo "Pass: bsk2017"
echo "Common Name: www.example.com"

# Generate a private key
openssl genrsa -aes256 -out server.key 2048
#  Generate a CSR (Certificate Signing Request)
openssl req -new -key server.key -out server.csr

# Remove Passphrase from key
# cp server.key server.key.org
# openssl rsa -in server.key.org -out server.key

# Generating a Self-Signed Certificate
openssl x509 -req -days 365 -in server.csr -signkey server.key -out server.crt

mkdir -p private/ && mv server.key private/
mkdir -p certs/ && mv server.crt certs/
