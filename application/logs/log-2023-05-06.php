<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-05-06 12:31:42 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No connection could be made because the target machine actively refused it.
 D:\xampp\htdocs\openseat\system\database\drivers\mysqli\mysqli_driver.php 202
ERROR - 2023-05-06 12:31:42 --> Unable to connect to the database
ERROR - 2023-05-06 12:34:48 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 12:37:54 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 12:37:54 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 12:37:54 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 12:38:05 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 12:38:05 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 12:38:05 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 12:39:06 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 12:39:06 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 12:39:06 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 12:39:08 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 12:39:08 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 12:39:08 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 12:40:51 --> 404 Page Not Found: Forgot_password/index
ERROR - 2023-05-06 12:42:07 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 12:42:07 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 12:42:07 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 12:55:13 --> 404 Page Not Found: Updated_html/images
ERROR - 2023-05-06 13:09:14 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'find_in_set(bk.service_ids)) as services
FROM `booking` `bk`
JOIN `business_w...' at line 1 - Invalid query: SELECT `bk`.`id`, `bk`.`seat_no`, `u`.`id`, `as` `user_id`, `u`.`fullname`, `u`.`profile_pic`, (select group_concat(service_name) from business_services where id find_in_set(bk.service_ids)) as services
FROM `booking` `bk`
JOIN `business_window` `bw` ON `bw`.`id`=`bk`.`window_id`
JOIN `users` `u` ON `u`.`id`=`bk`.`user_id`
WHERE `bk`.`window_id` = '5'
AND `bk`.`status` IN('Pending', 'Confirm')
AND date(bk.created) = '2023-05-06'
ORDER BY `bk`.`seat_no` ASC
ERROR - 2023-05-06 13:09:49 --> Query error: Unknown column 'as' in 'field list' - Invalid query: SELECT `bk`.`id`, `bk`.`seat_no`, `u`.`id`, `as` `user_id`, `u`.`fullname`, `u`.`profile_pic`, (select group_concat(service_name) from business_services where find_in_set(id, bk.service_ids)) as services
FROM `booking` `bk`
JOIN `business_window` `bw` ON `bw`.`id`=`bk`.`window_id`
JOIN `users` `u` ON `u`.`id`=`bk`.`user_id`
WHERE `bk`.`window_id` = '5'
AND `bk`.`status` IN('Pending', 'Confirm')
AND date(bk.created) = '2023-05-06'
ORDER BY `bk`.`seat_no` ASC
ERROR - 2023-05-06 13:24:02 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 13:24:07 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 13:24:07 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 13:24:07 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 13:24:08 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 13:24:19 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 13:24:19 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 13:24:19 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:02:48 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:02:48 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:02:48 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:02:54 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:02:54 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:02:54 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:08:33 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:08:33 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:08:33 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:08:42 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:08:42 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:08:42 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:08:48 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:08:48 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:08:48 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:08:54 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:08:54 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:08:54 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:08:58 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:08:58 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:08:58 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:09:06 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:09:06 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:09:06 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:09:21 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:09:21 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:09:21 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:09:27 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:09:27 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:09:27 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:22:59 --> 404 Page Not Found: Assets/front
ERROR - 2023-05-06 14:28:16 --> Severity: Notice --> Undefined index: seat_no D:\xampp\htdocs\openseat\application\views\front\detail.php 50
ERROR - 2023-05-06 14:28:16 --> Severity: Notice --> Undefined index: services D:\xampp\htdocs\openseat\application\views\front\detail.php 63
ERROR - 2023-05-06 14:28:16 --> Severity: Notice --> Undefined index: id D:\xampp\htdocs\openseat\application\views\front\detail.php 67
ERROR - 2023-05-06 14:28:16 --> Severity: Notice --> Undefined index: device_token D:\xampp\htdocs\openseat\application\views\front\detail.php 67
ERROR - 2023-05-06 14:28:16 --> Severity: Notice --> Undefined index: device_token D:\xampp\htdocs\openseat\application\views\front\detail.php 67
ERROR - 2023-05-06 14:28:16 --> Severity: Notice --> Undefined index: seat_no D:\xampp\htdocs\openseat\application\views\front\detail.php 50
ERROR - 2023-05-06 14:28:16 --> Severity: Notice --> Undefined index: services D:\xampp\htdocs\openseat\application\views\front\detail.php 63
ERROR - 2023-05-06 14:28:16 --> Severity: Notice --> Undefined index: id D:\xampp\htdocs\openseat\application\views\front\detail.php 67
ERROR - 2023-05-06 14:28:16 --> Severity: Notice --> Undefined index: device_token D:\xampp\htdocs\openseat\application\views\front\detail.php 67
ERROR - 2023-05-06 14:28:16 --> Severity: Notice --> Undefined index: device_token D:\xampp\htdocs\openseat\application\views\front\detail.php 67
ERROR - 2023-05-06 14:30:20 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\openseat\application\controllers\Front.php 297
ERROR - 2023-05-06 14:30:39 --> Severity: Notice --> Undefined index: seat_no D:\xampp\htdocs\openseat\application\views\front\detail.php 50
ERROR - 2023-05-06 14:30:39 --> Severity: Notice --> Undefined index: services D:\xampp\htdocs\openseat\application\views\front\detail.php 63
ERROR - 2023-05-06 14:30:39 --> Severity: Notice --> Undefined index: id D:\xampp\htdocs\openseat\application\views\front\detail.php 67
ERROR - 2023-05-06 14:30:39 --> Severity: Notice --> Undefined index: device_token D:\xampp\htdocs\openseat\application\views\front\detail.php 67
ERROR - 2023-05-06 14:30:39 --> Severity: Notice --> Undefined index: device_token D:\xampp\htdocs\openseat\application\views\front\detail.php 67
ERROR - 2023-05-06 14:31:40 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\openseat\application\views\front\detail.php 50
ERROR - 2023-05-06 14:31:40 --> Severity: Notice --> Undefined index: services D:\xampp\htdocs\openseat\application\views\front\detail.php 63
ERROR - 2023-05-06 14:31:40 --> Severity: Notice --> Undefined index: id D:\xampp\htdocs\openseat\application\views\front\detail.php 67
ERROR - 2023-05-06 14:31:40 --> Severity: Notice --> Undefined index: device_token D:\xampp\htdocs\openseat\application\views\front\detail.php 67
ERROR - 2023-05-06 14:31:40 --> Severity: Notice --> Undefined index: device_token D:\xampp\htdocs\openseat\application\views\front\detail.php 67
ERROR - 2023-05-06 14:32:03 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\openseat\application\views\front\detail.php 50
ERROR - 2023-05-06 14:32:03 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\openseat\application\views\front\detail.php 63
ERROR - 2023-05-06 14:32:03 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\openseat\application\views\front\detail.php 67
ERROR - 2023-05-06 14:32:03 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\openseat\application\views\front\detail.php 67
ERROR - 2023-05-06 14:32:03 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\openseat\application\views\front\detail.php 67
ERROR - 2023-05-06 14:32:16 --> Severity: Notice --> Undefined index: seat_no D:\xampp\htdocs\openseat\application\views\front\detail.php 50
ERROR - 2023-05-06 14:32:16 --> Severity: Notice --> Undefined index: services D:\xampp\htdocs\openseat\application\views\front\detail.php 63
ERROR - 2023-05-06 14:32:16 --> Severity: Notice --> Undefined index: id D:\xampp\htdocs\openseat\application\views\front\detail.php 67
ERROR - 2023-05-06 14:32:16 --> Severity: Notice --> Undefined index: device_token D:\xampp\htdocs\openseat\application\views\front\detail.php 67
ERROR - 2023-05-06 14:32:16 --> Severity: Notice --> Undefined index: device_token D:\xampp\htdocs\openseat\application\views\front\detail.php 67
ERROR - 2023-05-06 14:32:51 --> Severity: Warning --> array_search() expects parameter 2 to be array, object given D:\xampp\htdocs\openseat\application\controllers\Front.php 295
ERROR - 2023-05-06 14:32:51 --> Severity: Warning --> array_search() expects parameter 2 to be array, object given D:\xampp\htdocs\openseat\application\controllers\Front.php 295
ERROR - 2023-05-06 14:32:56 --> Severity: Warning --> array_search() expects parameter 2 to be array, object given D:\xampp\htdocs\openseat\application\controllers\Front.php 295
ERROR - 2023-05-06 14:32:56 --> Severity: Warning --> array_search() expects parameter 2 to be array, object given D:\xampp\htdocs\openseat\application\controllers\Front.php 295
ERROR - 2023-05-06 14:33:21 --> Severity: Warning --> array_search() expects parameter 2 to be array, object given D:\xampp\htdocs\openseat\application\controllers\Front.php 295
ERROR - 2023-05-06 14:33:21 --> Severity: Warning --> array_search() expects parameter 2 to be array, object given D:\xampp\htdocs\openseat\application\controllers\Front.php 295
ERROR - 2023-05-06 14:33:29 --> Severity: error --> Exception: Call to undefined function array_find() D:\xampp\htdocs\openseat\application\controllers\Front.php 293
ERROR - 2023-05-06 14:46:23 --> 404 Page Not Found: Updated_html/images
ERROR - 2023-05-06 14:49:10 --> Severity: Notice --> Undefined variable: detail D:\xampp\htdocs\openseat\application\views\front\business_window.php 68
ERROR - 2023-05-06 14:49:10 --> Severity: Notice --> Undefined variable: detail D:\xampp\htdocs\openseat\application\views\front\business_window.php 96
ERROR - 2023-05-06 14:51:29 --> Severity: Notice --> Undefined variable: detail D:\xampp\htdocs\openseat\application\views\front\business_window.php 94
ERROR - 2023-05-06 14:52:24 --> Severity: Notice --> Undefined variable: detail D:\xampp\htdocs\openseat\application\views\front\business_window.php 94
ERROR - 2023-05-06 14:53:09 --> Severity: Notice --> Undefined variable: detail D:\xampp\htdocs\openseat\application\views\front\business_window.php 94
ERROR - 2023-05-06 14:53:22 --> Severity: Notice --> Undefined variable: detail D:\xampp\htdocs\openseat\application\views\front\business_window.php 94
ERROR - 2023-05-06 14:55:14 --> Severity: Notice --> Undefined variable: detail D:\xampp\htdocs\openseat\application\views\front\business_window.php 13
ERROR - 2023-05-06 14:55:14 --> Severity: Notice --> Undefined variable: detail D:\xampp\htdocs\openseat\application\views\front\business_window.php 16
ERROR - 2023-05-06 14:55:14 --> Severity: Notice --> Undefined variable: detail D:\xampp\htdocs\openseat\application\views\front\business_window.php 18
ERROR - 2023-05-06 14:55:14 --> Severity: Notice --> Undefined variable: detail D:\xampp\htdocs\openseat\application\views\front\business_window.php 66
ERROR - 2023-05-06 14:55:14 --> Severity: Notice --> Undefined variable: detail D:\xampp\htdocs\openseat\application\views\front\business_window.php 94
ERROR - 2023-05-06 14:56:08 --> Severity: Notice --> Undefined variable: detail D:\xampp\htdocs\openseat\application\views\front\business_window.php 13
ERROR - 2023-05-06 14:56:08 --> Severity: Notice --> Undefined variable: detail D:\xampp\htdocs\openseat\application\views\front\business_window.php 18
ERROR - 2023-05-06 14:56:08 --> Severity: Notice --> Undefined variable: detail D:\xampp\htdocs\openseat\application\views\front\business_window.php 66
ERROR - 2023-05-06 14:56:08 --> Severity: Notice --> Undefined variable: detail D:\xampp\htdocs\openseat\application\views\front\business_window.php 94
ERROR - 2023-05-06 14:56:47 --> Severity: Notice --> Undefined variable: detail D:\xampp\htdocs\openseat\application\views\front\business_window.php 13
