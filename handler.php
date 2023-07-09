<?php
require_once (__DIR__.'/crest.php');
require_once (__DIR__.'/functions.php');

event_bind('onCrmDealAdd');
event_bind('OnTaskAdd');


$data = $_POST['key'];
dd($data);


// ---- VARIABLES ----
$query_limit = 50;
$query_quantity = 100;

$query_interval = 500000;
$time_start = microtime(true);

// ---- CRM.DEAL.ADD ----
$add_quantity_deals = $query_quantity;

$deals_add = [];
for($i = 1; $i <= $add_quantity_deals; $i++){
    $deals_add[] = [
        'method' => 'crm.deal.add',
        'params' => [
            'fields' => [
                'TITLE' => "$data "  . $i,
            ],
        ]
    ];
}

$requests = array_chunk($deals_add, $query_limit); // разбиваем пакеты по 50 штук



foreach($requests as $request) { // отправляем по 50 штук
    CRest::callBatch($request);
    query_interval_check();
}

// ---- CRM.DEAL.LIST ----
$show_quantity_deals = $query_quantity;

$deals_list = [];
$cycles = ceil($show_quantity_deals / $query_limit);
$count = 0;

for($i = 1; $i <= $cycles; $i++){
    $deals_list[] = [
        'method' => 'crm.deal.list',
        'params' => [
            'order' => ['ID' => 'DESC'],
            'select' => ['ID', 'TITLE', 'DATE_CREATE'],
            'start' => $count
        ]
    ];

    $count += $query_limit;
}

$result = CRest::callBatch($deals_list);

//echo "<pre>";
//print_r($count . PHP_EOL);
//print_r($cycles . PHP_EOL);
//print_r(separate_deals_list($result));
//echo "</pre>";


$test = separate_deals_list($result);


event_get();

?>

<html>

<table>
    <tr>
        <th>ID</th>
        <th>DATE_CREATE</th>
        <th>TITLE</th>

        <?php foreach($test as $value): ?>

    <tr>
        <td><?php echo $value['ID']?></td>
        <td><?php echo $value['DATE_CREATE']?></td>
        <td><?php echo $value['TITLE']?></td>
    </tr>

    <?php endforeach; ?>

</table>

</html>

