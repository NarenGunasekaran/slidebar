<?php
session_start();
include('DB.php');

if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$pass = $_POST['password'];

	$query=mysqli_query($conn,"select id from user where name='{$name}' and password='{$pass}'");
	if($query){
		$data = mysqli_fetch_assoc($query);	
		if($data['id']){
			$_SESSION['user'] = $name;
			$_SESSION['id'] = $data['id'];
			header('location:main.php');
		}else{
			header('location:index.php');
		}
	}
}

if(isset($_REQUEST['reload'])){
	$query = mysqli_query($conn,"select * from slidecounts where user_id={$_SESSION['id']}");
	while($row = mysqli_fetch_assoc($query)){
		$vv[] = array($row['count_type'] => $row['value']);
	}
	echo json_encode($vv);
}

if(isset($_REQUEST['mainSlider'])){
	$value = $_POST['value'];
	$query = mysqli_query($conn,"select * from slidecounts where user_id={$_SESSION['id']} and count_type='main'");

	$data = mysqli_num_rows($query);

	if($data > 0){
		$query1=mysqli_query($conn,"update slidecounts set value={$value} where user_id={$_SESSION['id']} and count_type='main'");
	}else{
		$query1=mysqli_query($conn,"insert into slidecounts(user_id,count_type,value) values({$_SESSION['id']},'main','$value')");		
	}
	$query2 = mysqli_query($conn,"select value from slidecounts where user_id={$_SESSION['id']} and count_type='main'");
	$data = mysqli_fetch_assoc($query2);
	echo $data['value'];
}

if(isset($_REQUEST['subSlider'])){
	$value = $_POST['value'];
	$id = $_POST['id'];
	$query = mysqli_query($conn,"select * from slidecounts where user_id={$_SESSION['id']} and count_type='sub{$id}'");
	$data = mysqli_num_rows($query);
	if($data > 0){
		$query1=mysqli_query($conn,"update slidecounts set value={$value} where user_id={$_SESSION['id']} and count_type='sub{$id}'");
	}else{
		$query1=mysqli_query($conn,"insert into slidecounts(user_id,count_type,value) values({$_SESSION['id']},'sub{$id}','$value')");
	}	
	$query2 = mysqli_query($conn,"select value from slidecounts where user_id={$_SESSION['id']} and count_type='sub{$id}'");
	$data = mysqli_fetch_assoc($query2);
	echo $data['value'];
}

if(isset($_REQUEST['subValues'])){
	$v = $_REQUEST['val'];
	$query = mysqli_query($conn,"select value from slidecounts where user_id={$_SESSION['id']} and count_type = 'sub{$v}'");
	$data = mysqli_fetch_assoc($query);
	echo $data['value'];
}
?>