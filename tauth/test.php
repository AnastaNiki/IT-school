<?php
require 'Database.php';

$db = new Database();

$db->insertUser('test@test.ru', 1234);