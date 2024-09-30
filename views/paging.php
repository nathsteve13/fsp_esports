<?php 
function generate_page($jml_data, $limit, $filter, $no_hal) {
    $hasil = "";
    $max_hal = ceil($jml_data / $limit);
    for ($hal = 1; $hal <= $max_hal; $hal++) {
        if ($no_hal == $hal) {
            $hasil .= "<b>$hal</b> "; 
        } else {
            $hasil .= "<a href='?page=$hal&cari=$filter'>$hal</a> ";
        }
    }
    return $hasil;
}
?>
