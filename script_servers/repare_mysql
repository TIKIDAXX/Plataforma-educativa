[mysqld]
user            = mysql
pid-file        = /run/mysqld/mysqld.pid
socket          = /run/mysqld/mysqld.sock
port            = 3306
basedir         = /usr
datadir         = /var/lib/mysql
tmpdir          = /tmp
lc-messages-dir = /usr/share/mysql
skip-external-locking

bind-address    = 0.0.0.0

log-error       = /var/log/mysql/error.log
slow_query_log  = 1
slow_query_log_file = /var/log/mysql/mysql-slow.log

# Recommended in standard MySQL setup
sql_mode=STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION
