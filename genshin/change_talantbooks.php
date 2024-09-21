<?php

include ("db.php");
$selectedDay = $_GET['day'];
$id_user = 1;

$res4 = mysqli_query($db, "SELECT DISTINCT(title), location, url_image, name FROM calculations 
    INNER JOIN quantity_indicator ON calculations.idcalculations=quantity_indicator.idcalculations
    INNER JOIN material ON quantity_indicator.idmaterial=material.idmaterial
    INNER JOIN material_has_weekday ON material.idmaterial=material_has_weekday.idmaterial
    INNER JOIN weekday ON material_has_weekday.idweekday=weekday.idweekday
    WHERE calculations.iduser='$id_user' AND weekday.idweekday='$selectedDay' AND quantity>0");
$row4 = mysqli_fetch_all($res4);
// Подготовка HTML для вывода картинок
$html = '';
for ($i = 0; $i < count($row4); $i++){
    $html .='<figure>
                <img src="'. $row4[$i][2]. '" width="50" height="50" alt="'.$row4[$i][0].'" title="'.$row4[$i][0].'" class="imageId"  data-location="'.$row4[$i][1].'">
            </figure>';
}

echo $html;
?>
