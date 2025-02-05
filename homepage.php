<?php
include("include/connect.php");
include("include/cart.php");
?>
<!DOCTYPE html>
<html lang="en" data-theme="cupcake" class="hero-overlay bg-opacity-60 -z-1">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <style>.parallax {

background-image: url("images/hero.png");


min-height: 250px; 
background-attachment: fixed;
background-position: center;
background-repeat: no-repeat;
background-size: cover;
}
</style>
</head>
<body class="parallax">
<div class="hero-overlay bg-opacity-60"><!-- div not closed -->
<div class="navbar flex justify-between flex-row bg-sun-50 h-16 rounded-full mt-2 m-2 top-2 sticky w-auto
 z-50">
 <div class="flex-1">
    <a href="admin/dashboard.php" class="btn btn-ghost normal-case text-xl"><img src="./images/LoGo2.png" width="150" height="150" alt="logo"></a>
  </div>
  <div class="flex-none gap-2">
    <div class="form-control">
      <input type="text" placeholder="Search" class="input input-bordered" />
    </div>

    <div class="flex-none">
    <div class="dropdown dropdown-end">
      <label tabindex="0" class="btn btn-ghost btn-circle">
        <div class="indicator">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
          <?php
          echo '<span class="badge badge-sm indicator-item">',$_SESSION['count'],'</span>';
          ?>
        </div>
      </label>
      <div tabindex="0" class="mt-3 card card-compact dropdown-content w-max bg-base-100 shadow">
        <div class="card-body">
        <?php 
          echo "<span class='font-bold text-lg'>",$_SESSION['count']," Items</span>";
          $total=0;
          $n=0;
foreach ($cart as $key => $value)
{
  $n+=1;
   $sql="SELECT * FROM products WHERE id='$key'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $name=$row["pname"];
    echo '<h2 class=" text-base text-dblue-300 truncate">',$n,'.&ensp;',strtoupper($name),'&ensp;<span class="badge badge-md ">',$value,'</span></h2>&ensp;';  
    $price=$row["price"];
    $price=(int)$price;
    $total+=$price;
    
}
echo "<span class='text-info text-base'>Subtotal: ₹",$total,"</span>";
      ?>
          <form method="post" class="card-actions">
            <button class="btn btn-primary btn-block"  name="checkout">Checkout</button>
            <button class="btn btn-secondary btn-block" name="clear_cart">Clear cart</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  

    <div class="dropdown dropdown-end">
      <label tabindex="0" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
          <img src="https://api.lorem.space/image/face?hash=33791" />
        </div>
      </label>
      <ul tabindex="0" class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
        <li><a href="profile.php">Profile</a></li>
        <li><a href="feedback.php">Feedback</a></li>
        <li><a href="list_user_orders.php">Orders</a></li>
        <li><a href="include/logout.php">Logout</a></li>

      </ul>
    </div>
  </div>
</div>
<div class="parallax">
<div class="hero min-h-screen">
  <div class="hero-overlay bg-opacity-60"></div>
  <div class="hero-content text-center text-neutral-content">
    <div class="max-w-md">
      <h1 class="mb-5 text-5xl  font-bold">Hello there</h1>
      <p class="mb-5 ">Pro
        amazing new collection has arrived.
      go pick your nex sneakers right now !!</p>
      <a href="shop.php"><button class="btn btn-primary">  Shop Now </button></a>
    </div>
  </div>
</div>
</div>
<?php
if (isset($_POST["clear_cart"]))
{
  $sql="DELETE FROM cart where user_id='$uid'";
  mysqli_query($conn,$sql);
  $_SESSION['count']=0;
}
if (isset($_POST["checkout"]))
{
header("Location:payment.php");
}
?>
</body>
</html>