<?php
$array = [
    ['id' => 1, 'date' => "12.01.2023", 'name' => "name1"],
    ['id' => 2, 'date' => "02.05.2023", 'name' => "name2"],
    ['id' => 5, 'date' => "03.08.2023", 'name' => "name5"],
    ['id' => 3, 'date' => "22.01.2023", 'name' => "name3"],
    ['id' => 4, 'date' => "11.11.2023", 'name' => "name4"],
    ['id' => 3, 'date' => "06.06.2023", 'name' => "name3"],
];

//1
$unique = array_values(array_reduce($array, function ($carry, $item) {
    if (!isset($carry[$item['id']])) {
        $carry[$item['id']] = $item;
    }
    return $carry;
}, []));

print_r($unique);


//2
usort($array, function($a, $b) {
    return $a['date'] <=> $b['date'];
});

print_r($array);

//3
$results = array_filter($array, function($item) {
    return $item['id'] == 3;
});

print_r($results);

//4
$restructuredArray = array_column($array, 'id', 'name');

print_r($restructuredArray);
