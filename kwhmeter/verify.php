<?php
$hashed = '$2y$10$pWEgMMMVAm4ZrbBim7zLZOxAytbZZLHLwpmltF3lKDbmqq4Xw9cP';

if (password_verify('1234', $hashed)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}