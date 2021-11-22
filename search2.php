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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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

    
    </style>
    </head>
    <body>
    <?php echo "<a class = 'sign_up' href='logout.php'> Logout " . $_SESSION['username'] . "</a>"; ?>
    <a class='sign_up' style='top:70px' href='add.php'> Have some data?</a>
    <div class="container">
        <div class="panel-group" id="results">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Search Results</p>
            <?php
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

            $password = 'password';

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

            function getReverseCorrectedValue($val){
                if($val == '1'){

                    return '0';
                }
                if($val == '-1'){
                    return '0.5';
                }
                if($val == '0.5'){
                    return '1';
                }
                if($val == '2'){
                    return '2';
                }
                if($val == '11'){
                    return '3';
                }
                return "";
            }

            function getCorrectedSign($val){
                if($val == '<'){

                    return ">";
                }
                if($val == '>'){

                    return "<";
                }
                if($val == '<='){

                    return ">=";
                }
                if($val == '>='){

                    return "<=";
                }
                if($val == '='){

                    return "=";
                }
                
                return "";
            }
           

            if (!isset($_SESSION['username'])) {
                header("Location: index.php");
            }

            if (isset($_POST['submit'])) {
                #$c_name = md5($_POST['c_name']);
                #$c_birth = md5($_POST['c_birth']);
                #$c_address = md5($_POST['c_address']);

                
                $selectClause = "SELECT * FROM patients_update";

                $whereClause = " WHERE ";

                $whereStarted = false;

               
                foreach($_POST as $key => $val)
                {
                    

                    if (strpos($key, 'sign') == false) {#
                        if ($val !== ""){
                            $sign_val = $key . "_sign";

                            if($whereStarted === true){
                                $whereClause .= " AND ";
                            }
                            else{
                                $whereStarted = true;
                            }
                            
                            if(isset($_POST[$sign_val])){
                                $sign = getCorrectedSign($_POST[$sign_val]);
                                
                                $whereClause .= $key . " " . $sign . " '" . openssl_encrypt(getCorrectedValue($val),"AES-128-ECB",$password) . "'";

                            }
                            else{

                                if($key == "MR_scanner"){
                                    $whereClause .= ' MATCH(MR_scanner) AGAINST ("' . $val .'") ';
                                }
                                else if($key === "c_id"){
                                    $whereClause .= $key." = '".$val."'";
                                }
                                else{
                                    $whereClause .= $key." = '".openssl_encrypt($val,"AES-128-ECB",$password) . "'";
                                }
                                
                            }
                            
                            
                        }
                    }#
                }

                $sql = $selectClause;
                if($whereClause != " WHERE "){
                    $sql .= $whereClause;
                }
                #echo $sql;
                #$c_name = openssl_encrypt($_POST['c_name'],"AES-128-ECB",$password);
                #$c_birth = openssl_encrypt($_POST['c_birth'],"AES-128-ECB",$password);
                #$c_address = openssl_encrypt($_POST['c_address'],"AES-128-ECB",$password);
                #$cdr = openssl_encrypt(getCorrectedValue($_POST['cdr']),"AES-128-ECB",$password);
                #checkAccess();
                

                

                $count = 1;
                $result = $conn -> query($sql);
                if ($result->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        if($_SESSION['username'] == 'administrator'){
                            $db_id = $row["c_id"];
                            $db_name = openssl_decrypt($row["c_name"],"AES-128-ECB",$password);
                            $heading = $db_name;
                            $db_birthday = openssl_decrypt($row["c_birth"],"AES-128-ECB",$password);
                            $db_address = openssl_decrypt($row["c_address"],"AES-128-ECB",$password);
                        }
                        else{
                            $heading = $count;
                            $count = $count +1;
                        }
                        
                        $db_dx1 = openssl_decrypt($row["dx1"],"AES-128-ECB",$password);
                        $db_cdr = getReverseCorrectedValue(openssl_decrypt($row["cdr"],"AES-128-ECB",$password));
                        $db_homehobb = getReverseCorrectedValue(openssl_decrypt($row["homehobb"],"AES-128-ECB",$password));
                        $db_judgement = getReverseCorrectedValue(openssl_decrypt($row["judgement"],"AES-128-ECB",$password));
                        $db_memory = getReverseCorrectedValue(openssl_decrypt($row["memory"],"AES-128-ECB",$password));
                        $db_MR_scanner = $row["MR_scanner"];
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#results" href="#<?= $heading ?>"><?= $heading ?></a>
                                </h4>
                            </div>
                            <div class="panel-collapse collapse" id="<?= $heading ?>">
                                <div class="panel-body">
                                    <?php 
                                    if($_SESSION['username'] == 'administrator'){?>
                                        <p><strong>ID: </strong><?= $db_id ?></p>
                                        <p><strong>Name: </strong><?= $db_name ?></p>
                                        <p><strong>Address: </strong><?= $db_address ?></p>
                                        <p><strong>Birthday: </strong><?= $db_birthday ?></p>
                                    <?php }
                                    ?>
                                    
                                    <p><strong>dx1: </strong><?= $db_dx1 ?></p>
                                    <p><strong>cdr: </strong><?= $db_cdr ?></p>
                                    <p><strong>homehobb: </strong><?= $db_homehobb ?></p>
                                    <p><strong>judgement: </strong><?= $db_judgement ?></p>
                                    <p><strong>memory: </strong><?= $db_memory ?></p>
                                    <p><strong>MR_scanner: </strong><?= $db_MR_scanner ?></p>
                                </div>
                                
                            </div>
                        </div>
                        <?php
                        
                    }
                    
                }
                else{
                    
                    echo "No records found.";
                   
                }

                

            }

            ?>
        </div>
        <p class="login-register-text"><a href="search1.php">Search Another Record</a></p>
    </div>
    
    </body>
</html>