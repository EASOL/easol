#! /bin/bash

# The objective of this script is to install the SQL Server ODBC driver, SQLCMD, and BCP utilities on Ubuntu 14.04

set -x

echo Install C compiler
sudo apt-get install build-essential -y

echo Install make
sudo apt-get install make -y

echo Update packages
sudo apt-get update

echo Download and unpack the Microsoft ODBC driver
wget -O msodbcsql.tar.gz http://download.microsoft.com/download/B/C/D/BCDD264C-7517-4B7D-8159-C99FC5535680/RedHat5/msodbcsql-11.0.2270.0.tar.gz
tar xvfz msodbcsql.tar.gz

echo Ensure that no existing version of the unixODBC driver is on the box
sudo apt-get remove libodbc1 unixodbc unixodbc-dev -y

echo Download and unpack unixODBC 2.3.0
wget -O unixODBC_230.tar.gz ftp://ftp.unixodbc.org/pub/unixODBC/unixODBC-2.3.0.tar.gz
tar xvfz unixODBC_230.tar.gz

echo Configure and make unixODBC
cd unixODBC-2.3.0/
./configure --disable-gui --disable-drivers --enable-iconv --with-iconv-char-enc=UTF8 --with-iconv-ucode-enc=UTF16LE
make
sudo make install

echo  Move to SQL Server driver folder
cd ~/msodbcsql-11.0.2270.0/lib64

echo Check for missing libraries required by the SQL Server driver
ldd ./libmsodbcsql-11.0.so.2270.0

echo Install Ubuntu package with missing libraries
sudo apt-get install libssl0.9.8 -y

echo Create symbolic links between the RHEL lib-names used by SQL Server driver and those used by the Ubuntu package
cd /lib/x86_64-linux-gnu/
sudo ln -s libssl.so.0.9.8 libssl.so.6
sudo ln -s libcrypto.so.0.9.8 libcrypto.so.6

echo Refreshe library cache
sudo ldconfig

echo Run the install script for the SQL Server driver
cd ~/msodbcsql-11.0.2270.0
sudo bash ./install.sh install --force

echo MS SQL Server ODBC Driver, sqlcmd and bcp installed.
