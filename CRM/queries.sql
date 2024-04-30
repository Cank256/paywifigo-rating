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
