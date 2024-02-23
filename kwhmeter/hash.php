<?php
$password = '1234';
$options = [
    'cost' => 10,
];
echo password_hash($password, PASSWORD_DEFAULT, $options);