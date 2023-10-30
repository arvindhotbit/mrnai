<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-02-28 21:41:52 --> 404 Page Not Found: admin/Cities/list
ERROR - 2023-02-28 21:42:22 --> 404 Page Not Found: admin/Cities/list
ERROR - 2023-02-28 21:53:32 --> Severity: error --> Exception: Call to undefined method Cmspage_model::get_sender_list() D:\xampp\htdocs\bulkmailer\application\controllers\admin\Cmscontent.php 451
ERROR - 2023-02-28 22:11:25 --> Query error: Table 'bulkmailer.cities' doesn't exist - Invalid query: SELECT U.*, U.first_name as name, (select title from cities where id=U.city_id) as city, (select count(id) from orders where user_id=U.id and status='Pending'  and is_deleted=0) as pending_orders, (select count(id) from orders where user_id=U.id and is_deleted=0) as total_orders
FROM `users` `U`
WHERE `U`.`is_deleted` =0
ORDER BY `U`.`id` DESC
ERROR - 2023-02-28 22:15:45 --> Query error: Table 'bulkmailer.cities' doesn't exist - Invalid query: SELECT U.*, U.first_name as name, (select title from cities where id=U.city_id) as city, (select count(id) from orders where user_id=U.id and status='Pending'  and is_deleted=0) as pending_orders, (select count(id) from orders where user_id=U.id and is_deleted=0) as total_orders
FROM `users` `U`
WHERE `U`.`is_deleted` =0
ORDER BY `U`.`id` DESC
ERROR - 2023-02-28 22:40:12 --> 404 Page Not Found: admin/User/list
ERROR - 2023-02-28 22:40:39 --> Severity: Notice --> Undefined variable: cities D:\xampp\htdocs\bulkmailer\application\views\admin\user\add.php 70
ERROR - 2023-02-28 22:40:39 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\bulkmailer\application\views\admin\user\add.php 70
