<?php
include('include/connect.php');
$uid=$_SESSION['uid'];
echo '<br>';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // collect value of input field
  $name = $_REQUEST['fname'];
  if (empty($name)) {
    echo 'Name is empty';
  } else {
    echo $name;
  }
}
$cart=array();
echo '<br>';
echo'<br>', $_SESSION['count'];
echo '<br>';
echo $uid;
echo '<br>';
// $sql='SELECT * FROM CART where user_id=$uid';
// $result=mysqli_query($conn,$sql);
// $row=mysqli_fetch_assoc($result);
$sql='SELECT nos,product_id FROM CART where user_id=$uid';
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$nos=array();
foreach($result as $row)
{
$cart[$row['product_id']] = $row['nos'];

}
print_r($cart);
echo '<br>';
//$result = mysqli_query($conn,'SELECT SUM(nos) fro m cart where user_id=$uid');
$tnos=mysqli_fetch_row($result);
echo $tnos[0],'<br>';
//print_r($tnos);
$time=getdate();

$_SESSION['$products']=json_encode($cart);
//print_r($_SESSION['$products']);
print_r($cart);
$cnt=count($cart);
echo $cnt;
//echo $time,'<br>';
?>

<select name='status' class='select select-primary w-full max-w-xs'>
   <input hidden type='number' name='id' value=',$row["order_id"],'><br>
    <option disabled selected>UPDATE ORDER STATUS</option>
    <option value='0'>ORDER PLACED</option>
    <option value='1'>IN TRANSIT</option>
    <option value='2'>DELIVERED</option>