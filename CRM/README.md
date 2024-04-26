# php_sessions_template
Basic Session Handling with PHP
It includes CSRF Protection with the owasp/csrf-protector-php class file


Sales Dashboard Scripts

select count(*) as todaysorders, coalesce(sum(amount),0.00) as todays_sales, (SELECT DATE_SUB(CURDATE(), INTERVAL 1 DAY) AS yesterday_date) as
yesterday_date, (select coalesce(sum(amount),0.00) from payment where creationdate >= yesterday_date and creationdate < CURDATE()) as yesterday_sales, coalesce(avg(amount),0.00) as averageorderamt, (select coalesce(avg(amount),0.00) from payment where creationdate >= yesterday_date and creationdate < CURDATE()) as avgorderamt_yesterday  from payment where creationdate >= CURDATE();
+--------------+--------------+----------------+-----------------+-----------------+-----------------------+
| todaysorders | todays_sales | yesterday_date | yesterday_sales | averageorderamt | avgorderamt_yesterday |
+--------------+--------------+----------------+-----------------+-----------------+-----------------------+
|            2 |        57.00 | 2024-04-25     |            2.00 |       28.500000 |              1.000000 |
+--------------+--------------+----------------+-----------------+-----------------+-----------------------+
1 row in set (0.00 sec)


Sales amount for Seven Days Query
SELECT 
    CURDATE() AS today,
    COALESCE(SUM(amount), 0.00) AS todaySales,
    DATE_SUB(CURDATE(), INTERVAL 1 DAY) AS day1_before,
    COALESCE((
        SELECT SUM(amount) FROM payment
        WHERE creationdate >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)
        AND creationdate < CURDATE()
    ), 0.00) AS yesterday_sales,
    DATE_SUB(CURDATE(), INTERVAL 2 DAY) AS day2_before,
    COALESCE((
        SELECT SUM(amount) FROM payment
        WHERE creationdate >= DATE_SUB(CURDATE(), INTERVAL 2 DAY)
        AND creationdate < DATE_SUB(CURDATE(), INTERVAL 1 DAY)
    ), 0.00) AS day2_before_sales,
    DATE_SUB(CURDATE(), INTERVAL 3 DAY) AS day3_before,
    COALESCE((
        SELECT SUM(amount) FROM payment
        WHERE creationdate >= DATE_SUB(CURDATE(), INTERVAL 3 DAY)
        AND creationdate < DATE_SUB(CURDATE(), INTERVAL 2 DAY)
    ), 0.00) AS day3_before_sales,
    DATE_SUB(CURDATE(), INTERVAL 4 DAY) AS day4_before,
    COALESCE((
        SELECT SUM(amount) FROM payment
        WHERE creationdate >= DATE_SUB(CURDATE(), INTERVAL 4 DAY)
        AND creationdate < DATE_SUB(CURDATE(), INTERVAL 3 DAY)
    ), 0.00) AS day4_before_sales,
    DATE_SUB(CURDATE(), INTERVAL 5 DAY) AS day5_before,
    COALESCE((
        SELECT SUM(amount) FROM payment
        WHERE creationdate >= DATE_SUB(CURDATE(), INTERVAL 5 DAY)
        AND creationdate < DATE_SUB(CURDATE(), INTERVAL 4 DAY)
    ), 0.00) AS day5_before_sales,
    DATE_SUB(CURDATE(), INTERVAL 6 DAY) AS day6_before,
    COALESCE((
        SELECT SUM(amount) FROM payment
        WHERE creationdate >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
        AND creationdate < DATE_SUB(CURDATE(), INTERVAL 5 DAY)
    ), 0.00) AS day6_before_sales
FROM payment
WHERE creationdate >= CURDATE();

+------------+------------+-------------+-----------------+-------------+-------------------+-------------+-------------------+-------------+-------------------+-------------+-------------------+-------------+-------------------+
| today      | todaySales | day1_before | yesterday_sales | day2_before | day2_before_sales | day3_before | day3_before_sales | day4_before | day4_before_sales | day5_before | day5_before_sales | day6_before | day6_before_sales |
+------------+------------+-------------+-----------------+-------------+-------------------+-------------+-------------------+-------------+-------------------+-------------+-------------------+-------------+-------------------+
| 2024-04-26 |      57.00 | 2024-04-25  |            2.00 | 2024-04-24  |              0.00 | 2024-04-23  |              0.00 | 2024-04-22  |              1.00 | 2024-04-21  |              0.00 | 2024-04-20  |              0.00 |
+------------+------------+-------------+-----------------+-------------+-------------------+-------------+-------------------+-------------+-------------------+-------------+-------------------+-------------+-------------------+
1 row in set (0.00 sec)

mysql> 


