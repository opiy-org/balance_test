Install
===

```
sudo -u postgres psql

CREATE DATABASE btest;
CREATE USER btest WITH password 'btest';
GRANT ALL ON DATABASE btest TO btest;

```


```
#sh ./isntall.sh
```


Usage
===

```
#list all users
php artisan users

#list all transfers
php artisan transfers


#transfer money
php artisan transfer FROM_USERID  TO_USERID  SUMM
```