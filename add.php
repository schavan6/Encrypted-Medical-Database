<?php

//include 'config.php';

$server = "localhost";
$user = "root";
$pass = "root";
$database = "ads_project";
$port = 3306;




$conn = new mysqli($server, $user, $pass, $database);

if($conn -> connect_error){
    die("connection failed! ". $conn -> connect_error);
}

error_reporting(1);

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}


/**
 * Encrypt a message
 *
 * @param string $message - message to encrypt
 * @param string $key - encryption key
 * @return string
 * @throws RangeException
 */

function getCorrectedValue($val){
    if($val == '0'){

        return 1;
    }
    if($val == '0.5'){
        return -1;
    }
    if($val == '1'){
        return 0.5;
    }
    if($val == '2'){
        return 2;
    }
    if($val == '3'){
        return 11;
    }
    return "";
}

if (isset($_POST['submit'])) {
    $password = 'password';
	$c_id = $_POST['c_id'];
	$c_name = $_POST['c_name'];
	$c_birth = $_POST['c_birth'];
    $c_address = $_POST['c_address'];
    $dx1 = $_POST['dx1'];
    $cdr = getCorrectedValue($_POST['cdr']);
    $homehobb = getCorrectedValue($_POST['homehobb']);
	$judgement = getCorrectedValue($_POST['judgement']);
	$memory = getCorrectedValue($_POST['memory']);
	$orient = getCorrectedValue($_POST['orient']);
    $commun = getCorrectedValue($_POST['commun']);
    $persare = getCorrectedValue($_POST['persare']);
    $MR_scanner = $_POST['MR_scanner'];
    $t1w = $_POST['t1w'];
    $t2w = $_POST['t2w'];

    $sql = "SELECT * FROM patients WHERE c_id='$c_id'";
    $result = $conn -> query($sql);

    if (!$result->num_rows > 0) {

        $c_name = openssl_encrypt($c_name,"AES-128-ECB",$password);
        $c_birth = openssl_encrypt($c_birth,"AES-128-ECB",$password);
        $c_address = openssl_encrypt($c_address,"AES-128-ECB",$password);
        $dx1 = openssl_encrypt($dx1,"AES-128-ECB",$password);
        $cdr = openssl_encrypt($cdr,"AES-128-ECB",$password);
        $homehobb = openssl_encrypt($homehobb,"AES-128-ECB",$password);
        $judgement = openssl_encrypt($judgement,"AES-128-ECB",$password);
        $memory = openssl_encrypt($memory,"AES-128-ECB",$password);
        $orient = openssl_encrypt($orient,"AES-128-ECB",$password);
        $commun = openssl_encrypt($commun,"AES-128-ECB",$password);
        $persare = openssl_encrypt($persare,"AES-128-ECB",$password);
        
        $sql = "INSERT INTO patients_update (c_id, c_name, c_birth, c_address,
                                      dx1, cdr, homehobb, judgement,
                                      memory, orient, commun, persare, MR_scanner,t1w_url,t2w_url)
    					VALUES ('$c_id', '$c_name', '$c_birth','$c_address','$dx1','$cdr','$homehobb',
    					'$judgement','$memory','$orient','$commun', '$persare', '$MR_scanner','$t1w','$t2w' )";
        
    	$result = $conn -> query($sql);
    	
    	if ($result) {
            echo "<script>alert('Record added!')</script>";
            $c_id = "";
            $c_name = "";
            $c_birth = "";
            $c_address = "";
            $dx1 = "";
            $cdr = "";
            $homehobb = "";
            $judgement = "";
            $memory = "";
            $orient = "";
            $sumbox = "";
            $t1w = "";
            $t2w = "";
        }else {
           	echo "<script>alert('Woops! Something Wrong Went.')</script>";
            
           	}
    }else {
        echo "<script>alert('Woops! Record Already Exists.')</script>";

    }


}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Welcome</title>
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

    </style>
</head>
<body>

    <?php echo "<a class = 'sign_up' href='logout.php'> Logout " . $_SESSION['username'] . "</a>"; ?>
    <a class='sign_up' style='top:70px' href='search1.php'> Look for searching?</a>
    <div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Add Record</p>
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
			<div class="input-group">
                <select class="number-select" name= "dx1">
                    <option selected="true" disabled="disabled">dx1</option>
                    <option>AD dementia</option>
                    <option>Cognitively normal</option>
                </select>
            </div>
            <div class="input-group">
                
                <select name= "cdr">
                    <option selected="true" disabled="disabled">cdr</option>
                    <option>0</option>
                    <option>0.5</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>
            <div class="input-group">
                
                <select name= "homehobb">
                    <option selected="true" disabled="disabled">homehobb</option>
                    <option>0</option>
                    <option>0.5</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>
            <div class="input-group">
                
                <select name= "judgement">
                    <option selected="true" disabled="disabled">judgement</option>
                    <option>0</option>
                    <option>0.5</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>
            <div class="input-group">
                
                <select name= "memory">
                    <option selected="true" disabled="disabled">memory</option>
                    <option>0</option>
                    <option>0.5</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>
            <div class="input-group">
                
                <select name= "orient">
                    <option selected="true" disabled="disabled">orient</option>
                    <option>0</option>
                    <option>0.5</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>
            <div class="input-group">
                
                <select name= "commun">
                    <option selected="true" disabled="disabled">commun</option>
                    <option>0</option>
                    <option>0.5</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>
            <div class="input-group">
                
                <select name= "persare">
                    <option selected="true" disabled="disabled">persare</option>
                    <option>0</option>
                    <option>0.5</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>
            <div class="input-group">
                <input type="text" placeholder="MR scanner type" name="MR_scanner">
            </div>
            <div class="input-group">
                <input type="file" placeholder="t1w" name="t1w">
            </div>
            <div class="input-group">
                <input type="file" placeholder="t2w" name="t2w">
            </div>
			<div class="input-group">
				<button name="submit" class="btn">Submit</button>
			</div>
			<p class="login-register-text">trying to search data? <a href="search.php">Click Here</a>.</p>
		</form>


    </div>
</body>
</html>