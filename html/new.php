<?php
$array=['a','b','c'];
print_r($array);
echo $array['1'];
echo "<br/>";
$arr=["color"=>"red","color2"=>"green"];
print_r($arr);
echo "<ul>";
foreach($arr as $color){
    echo "<li>";
    echo $color;
    echo "</li>";
}
echo"</ul>";
$arr=["capsicum_1","cheese_2"];
