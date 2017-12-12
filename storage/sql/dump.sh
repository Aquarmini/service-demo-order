#!/usr/bin/env bash
mysqldump -uroot -p910123 -h 127.0.0.1 --port 3307 order_0 > order.sql