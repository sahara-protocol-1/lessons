<?php

function event_get() {
    $events = CRest::call(
        'event.get',
        []
    );
    file_put_contents('event.txt', print_r($events, true), 0);
}

function event_bind($event) {
    $event_bind = CRest::call(
        'event.bind', [
            'event' => $event,
            'handler' => 'https://12344test.ru/handler_eventbind.php'
        ]
    );
}

function dd($data) {
    echo "<pre>";
    echo $data;
    echo "</pre>";
}

function separate_deals_list($data) {
    $data = $data['result']['result'];
    $count = count($data);

    for($i = 0; $i < $count; $i++) {
        $some_array[] = $data[$i];
    }

    $some_array = array_reduce($some_array, 'array_merge', []);

    return $some_array;
}

function query_interval_check(){
    global $time_start;
    global $query_interval;

    $time_end = microtime(true);
    $difference = ($time_end - $time_start) * 1000000;
    $wait_time = $query_interval - $difference;
    $wait_time = intval($wait_time);

    ($wait_time > 0) ? usleep($wait_time) : null;
    
    $time_start = microtime(true);
}

