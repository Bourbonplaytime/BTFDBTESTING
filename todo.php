<?php 
    include 'list.php';

    $status = false;
    $field = 'priority';
    $filter = array();

    foreach ($list as $originalKey => $item) {
        if($status === 'all' || $item['complete'] === $status) {
            if(isset($field) && isset($item[$field])) {
                $filter[$originalKey] = $item[$field];
            } else {
                $filter[$originalKey] = $item['priority']+12;
            }
        }
    }
    asort($filter);
    //echo '<pre>';
    //var_dump($filter, $list);
    //echo '</pre>';

    echo '<table>';
    echo '<tr>';
    echo '<th>Title</th>';
    echo '<th>Priority</th>';
    echo '<th>Due Date</th>';
    echo '<th>Complete</th>';
    echo '</tr>';
    foreach ($filter as $id => $value) {
        echo '<tr>';
        echo '<td>' . $list[$id]['title'] . "</td>";
        echo '<td>' . $list[$id]['priority'] . "</td>";
        echo '<td>' . $list[$id]['due'] . "</td>";
        echo '<td>';
        if($list[$id]['complete']) {
            echo 'Yes';
        } else {
            echo 'No';
        }
        echo "</td>";
        echo '</tr>';
    }
    echo '</table>';
    //var_dump($list);

?>