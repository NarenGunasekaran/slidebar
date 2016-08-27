<?php
session_start();
include('DB.php');

if(!$_SESSION['user']){
	header('location:index.php');
}


$query = mysqli_query($conn,"select value from slidecounts where user_id={$_SESSION['id']} and count_type='main'");
$data = mysqli_fetch_assoc($query);

$query1 = mysqli_query($conn,"select * from slidecounts where user_id={$_SESSION['id']} and count_type <> 'main'");

?>

<html>
<head>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap/css/style.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
</head>
<body>
	<div class="clear">
	<div class="container">
		<a href="logout.php">Logout</a> 
		<div class="jumbotron">
			<div class="row">
				<div class="col-lg-6">
					<input type="range" id="mainSlider" min="0" max="10" value="<?php if($data['value']){echo $data['value'];}else{echo "0";}?>" step="1"/>
				</div>
				<div class="col-lg-2">
					<h5>Slider Value = <span id="valMainSlider"><?php if($data['value']){echo $data['value'];}else{echo "0";}?></span></h5>
				</div>
			</div>
			<div class="row" id="SUB1">
				<?php
					for($i = 1;$i <= $data['value']; $i++){

					}
					// while($row = mysqli_fetch_assoc($query1)){
					// 	echo '<div class="col-lg-6"><input type="range" id="subSlider" min="0" max="10" value="'.$row['value'].'" step="1"/></div><div class="col-lg-2"><h5>Slider Value = <span id="valSubSlider">'.$row['value'].'</span></h5></div>';
					// }
				?>
			</div>
			<div class="row" id="SUB">
				<!-- <div class="col-lg-6">
					<input type="range" min="0" max="10" value="0" step="1"/>
				</div>
				<div class="col-lg-2">
					<h5>Slider Value = <span id="valSubSlider">0</span></h5>
				</div> -->
			</div>
		
		</div>
	</div>

<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">

$('#mainSlider').on('change',function(){
	var a = this.value;
	$.ajax({
		url: "connect.php?mainSlider",
		type: "POST",
		data: "value="+a,
		success:function(data){
			$('#valMainSlider').html(data);
			$('#SUB1').hide();
			$('.new').remove();
			for(var i = 1; i <= data; i++){
				$('#SUB').append("<div class='col-lg-6 new'><input type='range' id='subSlider_"+i+"' min='0' max='10' value='0' step='1'/></div><div class='col-lg-2 new'><h5>Sub Slider Value = <span id='valSubSlider_"+i+"'>"+getValue(i)+"</span></h5></div>");
			}

			for(var i = 1; i <= data; i++){
				$('#subSlider_'+i).on('change',function(){
					var b = this.value;
					var id = this.id;
					id = id.substr(id.length - 1);
					$.ajax({
						url: "connect.php?subSlider",
						type: "POST",
						data: "value="+b+"&id="+id,
						success:function(data){
							$('#valSubSlider_'+id).html(data);
						}
					});
				});
			}

			 //viewDisplayMain();
			
		}
	});
	
});

function getValue(c){
	$.ajax({
		url : "connect.php?subValues&val="+c,
		type : "GET", 
		success: function(data){
			if(data){
				$('#valSubSlider_'+c).html(data);
			}else{
				$('#valSubSlider_'+c).html('0');
			}
			
		}
	});
	
}

function viewDisplayMain(){
	$.ajax({
		url : "connect.php?display",
		type : "GET",
		success: function(data){
			console.log(data);
		}
	});
}
</script>
</body>
</html>