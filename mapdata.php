<?php
require_once('config.php');
$con=mysqli_connect(HOST, USERNAME, PASSWORD);
mysqli_set_charset($con, "utf8");
mysqli_select_db($con, 'experience_base');

$type = isset($_POST["type"]) ? $_POST["type"] : '';
if ($type == 'user')
{
    $query = mysqli_query($con, "select * from eb_users");
    while($row = mysqli_fetch_array($query)){
        $sx_id = $row['sx_id'];
        $unit1 = mysqli_fetch_array(mysqli_query($con, "select * from eb_sx_list WHERE sx_id='$sx_id'"))['unit1'];
        if ($unit1) {$unit_sum[] = $unit1;}
    }
    $count_sum = array_count_values($unit_sum);
    foreach ($count_sum as $name => $num)
    {
        $ret[] = array(
            'name' => $name,
            'value' => $num
        );
    }
    mysqli_close($con);
    echo json_encode($ret); //输出json格式数据
}
else if ($type == 'passage')
{
    $query = mysqli_query($con, "select * from eb_passages WHERE status='publish'");
    while($row = mysqli_fetch_array($query)){
        $extypes[] = $row['extype2'];
    }
    $count_sum = array_count_values($extypes);
    foreach ($count_sum as $name => $num)
    {
        $ret[] = array(
            'name' => $name,
            'value' => $num
        );
    }
    mysqli_close($con);
    echo json_encode($ret); //输出json格式数据

}

?>