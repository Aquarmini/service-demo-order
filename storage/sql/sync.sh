#!/usr/bin/env bash
mysql -uroot -p910123 -h 127.0.0.1 --port 3307 order_1 < order.sql
mysql -uroot -p910123 -h 127.0.0.1 --port 3307 order_2 < order.sql
mysql -uroot -p910123 -h 127.0.0.1 --port 3307 order_3 < order.sql
mysql -uroot -p910123 -h 127.0.0.1 --port 3307 order_4 < order.sql
mysql -uroot -p910123 -h 127.0.0.1 --port 3307 order_5 < order.sql
mysql -uroot -p910123 -h 127.0.0.1 --port 3307 order_6 < order.sql
mysql -uroot -p910123 -h 127.0.0.1 --port 3307 order_7 < order.sql
