<?php
	

	error_reporting(1);

	session_start();

	if (!isset($_SESSION['username'])) {
	    header("Location: index.php");
	}

	
?>

<!DOCTYPE html>
<html>
<head>
	
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Search Records</title>
    <style>
    a.sign_up {
        position: absolute;
        top: 30px;
        right: 90px;
        z-index: 2;
        font-size:20px;
        border-radius:0.12em;
        box-sizing: border-box;
        font-family:fantasy;
        font-weight: bold;
        font-weight: 400;
        padding:0.35em 1.2em;
        color:#FFFFFF;
        transition: all 0.2s;
        text-decoration:none;

    }
    a.sign_up:hover{
        color:#000000;
        background-color:#FFFFFF;
    }

    select{
    	margin: 5px;
	    width: 100%;
	    height: 100%;
	    border: 2px solid #e7e7e7;
	    padding: 15px 20px;
	    font-size: 1rem;
	    border-radius: 30px;
	    background: transparent;
	    outline: none;
	    transition: .3s;
	    border-color: #a29bfe;
	}
	label{
		margin-top: 9px;
		padding: 10px;
		float: left;
		width: 28%;
	}
	.number-select{
		width: 44%;
	}
	.sign-select{
		width: 22%;
		float: left;
	}
    </style>
</head>
<body>
	<?php echo "<a class = 'sign_up' href='logout.php'> Logout " . $_SESSION['username'] . "</a>"; ?>
    <a class='sign_up' style='top:70px' href='add.php'> Have some data?</a>
	<div class="container">
		<form action="./search2.php" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Search Records</p>
			<?php 
			if($_SESSION['username'] == 'administrator'){
			?>
				<div class="input-group">
					<input type="text" placeholder="ID" name="c_id">
				</div>
				<div class="input-group">
					<input type="text" placeholder="Name" name="c_name">
				</div>
				<div class="input-group">
					<input type="date" placeholder="Data Birth" name="c_birth">
	            </div>
	            <div class="input-group">
					<input type="text" placeholder="City" name="c_address">
				</div>
			<?php }?>
			<div class="input-group">
				<select name= "dx1">
					<option selected="true" disabled="disabled">dx1</option>
					<option>AD dementia</option>
					<option>Cognitively normal</option>
				</select>
			</div>
			<div class="input-group">
				<label>cdr</label>
				<select class="sign-select" name= "cdr_sign">
					<option>=</option>
					<option><</option>
					<option><=</option>
					<option>></option>
					<option>>=</option>
				</select>
				<select class="number-select" name= "cdr">
					<option selected="true" disabled="disabled">cdr</option>
					<option>0</option>
					<option>0.5</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
				</select>
			</div>
			<div class="input-group">
				<label>homehobb</label>
				<select class="sign-select" name= "homehobb_sign">
					<option>=</option>
					<option><</option>
					<option><=</option>
					<option>></option>
					<option>>=</option>
				</select>
				<select class="number-select" name= "homehobb">
					<option selected="true" disabled="disabled">homehobb</option>
					<option>0</option>
					<option>0.5</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
				</select>
			</div>
			<div class="input-group">
				<label>judgement</label>
				<select class="sign-select" name= "judgement_sign">
					<option>=</option>
					<option><</option>
					<option><=</option>
					<option>></option>
					<option>>=</option>
				</select>
				<select class="number-select" name= "judgement">
					<option selected="true" disabled="disabled">judgement</option>
					<option>0</option>
					<option>0.5</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
				</select>
			</div>
			<div class="input-group">
				<label>memory</label>
				<select class="sign-select" name= "memory_sign">
					<option>=</option>
					<option><</option>
					<option><=</option>
					<option>></option>
					<option>>=</option>
				</select>
				<select class="number-select" name="memory">
					<option selected="true" disabled="disabled">memory</option>
					<option>0</option>
					<option>0.5</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
				</select>
			</div>
			<div class="input-group">
				<label>orient</label>
				<select class="sign-select" name= "orient_sign">
					<option>=</option>
					<option><</option>
					<option><=</option>
					<option>></option>
					<option>>=</option>
				</select>
				<select class="number-select" name= "orient">
					<option selected="true" disabled="disabled">orient</option>
					<option>0</option>
					<option>0.5</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
				</select>
			</div>
			<div class="input-group">
				<label>persare</label>
				<select class="sign-select" name= "persare_sign">
					<option>=</option>
					<option><</option>
					<option><=</option>
					<option>></option>
					<option>>=</option>
				</select>
				<select class="number-select" name= "persare">
					<option selected="true" disabled="disabled">persare</option>
					<option>0</option>
					<option>0.5</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
				</select>
			</div>
			<div class="input-group">
				<input type="text" placeholder="MR Scanner" name="MR_scanner">
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Submit</button>
			</div>
		</form>
		<p><?=$row["c_name"]?></p>
	</div>
</body>
</html>