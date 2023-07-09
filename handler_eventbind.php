<?php

file_put_contents('event_last.txt', print_r($GLOBALS, true), 0);

// file_put_contents('events_list.txt', print_r($GLOBALS, true) . "\n", FILE_APPEND);


if(!empty($_POST['data']['FIELDS']['ID'])){
    file_put_contents('events_deals_id.txt', $_POST['data']['FIELDS']['ID'] . "\n", FILE_APPEND);
}
