<?php


$db = new SQLite3('database.db');



$insertsql = 'DROP TABLE Characters;
            DROP TABLE Forum;
            DROP TABLE Users;
            ';

$db->query($insertsql);
?>