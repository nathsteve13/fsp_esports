<?php
function generate_page($jml_data, $limit, $filter, $no_hal) {
    $hasil = "";
    $max_hal = ceil($jml_data / $limit); 
    for ($hal = 1; $hal <= $max_hal; $hal++) {

        if ($no_hal == $hal) {
            $hasil .= "<b>$hal</b> "; 
        } else {
            $hasil .= "<a href='?page=$hal&cari=" . $filter . "'>$hal</a> ";
        }
    }
    return $hasil;
}

function generate_pageT($total_data, $limit, $idteam, $current_page) {
    $total_pages = ceil($total_data / $limit); 
    $pagination = '';
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            $pagination .= "<span>$i</span> ";
        } else {
            $pagination .= "<a href=\"?page=$i&idteam=$idteam\">$i</a> ";
        }
    }
    return $pagination;
}
?>
