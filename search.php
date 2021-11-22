<?php

include 'config.php';
session_start();
error_reporting(0);

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}


$search_value=$_POST["search"];
if (isset($_POST['submit'])) {
    if($conn->connect_error){
        echo 'Connection Faild: '.$conn->connect_error;
    }else{
        
        #vvVqSxriSR+KuZjAE356LA==
        $password = 'password';
        $c_name = openssl_encrypt($search_value,"AES-128-ECB",$password);

        $sql = "SELECT * FROM patients WHERE c_name like '%$c_name%'";
        echo "$sql";
       
        $result = $conn -> query($sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "<div class='search_results'>c_id: ".$row["c_id"]."</div>";
            echo "<div class='search_results'>c_id: ".$row["t1w"]."</div>";
            $c_name = openssl_decrypt($row["c_name"],"AES-128-ECB",$password);
            echo "<div class='search_results'>c_name: ".$row["c_name"]."</div>";
            echo "<div class='search_results'>c_name: ".$c_name."</div>";
            echo copy($row["c_name"],"/Applications/MAMP/htdocs/ads/save_file/download.nii");
//             file_put_contents('/path/to/new/file_name', $my_blob);
//             header('Content-Type:application/gzip');
            echo "<div class='search_results'>".$row["t1w"]."</div>";
//             file_put_contents('/Applications/MAMP/htdocs/ads/', $row["t1w"]);
//             $myfile = fopen("newfile.ni", "w") or die("Unable to open file!");
//             fwrite($myfile, $row["t1w"]);

//             echo "<script type="text/javascript">
//                 var x = <?php echo "$"
//                 $row["t1w"]. ".addEventListener('change', handleFileSelect, false);
// //             </script>"
//             $files =
//             readFile(files[0]);
//             echo gettype($data);
//             echo "here\n";
//             echo '<script type="text/JavaScript">
//                  prompt("GeeksForGeeks");
//                  handleFileSelect({$row['t1w']});
//                  prompt("GeeksForGeeks");
//                  </script>'
//             ;

//             echo "<script type='text/javascript'>handleFileSelect({$row['t1w']});</script>";
//             echo "<script type='text/javascript'>handleFileSelect(data);</script>";
//             echo "here\n";


//             echo "<script type='text/javascript'>readFile({$row['t1w']});</script>";


        }

    }
}
?>

<!DOCTYPE html>

<!-- Test: Typical fullscreen usage; autoload an image and overlay. -->

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <script type="text/javascript" src="nifti-reader.js"></script>

    <script type="text/javascript">
        function readNIFTI(name, data) {
            window.alert(5 + 6);
            var canvas = document.getElementById('myCanvas');
            var slider = document.getElementById('myRange');
            var niftiHeader, niftiImage;

            // parse nifti
            if (nifti.isCompressed(data)) {
                data = nifti.decompress(data);
            }

            if (nifti.isNIFTI(data)) {
                niftiHeader = nifti.readHeader(data);
                niftiImage = nifti.readImage(niftiHeader, data);
            }

            // set up slider
            var slices = niftiHeader.dims[3];
            slider.max = slices - 1;
            slider.value = Math.round(slices / 2);
            slider.oninput = function() {
                drawCanvas(canvas, slider.value, niftiHeader, niftiImage);
            };

            // draw slice
            drawCanvas(canvas, slider.value, niftiHeader, niftiImage);
        }

        function drawCanvas(canvas, slice, niftiHeader, niftiImage) {
            // get nifti dimensions
            var cols = niftiHeader.dims[1];
            var rows = niftiHeader.dims[2];

            // set canvas dimensions to nifti slice dimensions
            canvas.width = cols;
            canvas.height = rows;

            // make canvas image data
            var ctx = canvas.getContext("2d");
            var canvasImageData = ctx.createImageData(canvas.width, canvas.height);

            // convert raw data to typed array based on nifti datatype
            var typedData;

            if (niftiHeader.datatypeCode === nifti.NIFTI1.TYPE_UINT8) {
                typedData = new Uint8Array(niftiImage);
            } else if (niftiHeader.datatypeCode === nifti.NIFTI1.TYPE_INT16) {
                typedData = new Int16Array(niftiImage);
            } else if (niftiHeader.datatypeCode === nifti.NIFTI1.TYPE_INT32) {
                typedData = new Int32Array(niftiImage);
            } else if (niftiHeader.datatypeCode === nifti.NIFTI1.TYPE_FLOAT32) {
                typedData = new Float32Array(niftiImage);
            } else if (niftiHeader.datatypeCode === nifti.NIFTI1.TYPE_FLOAT64) {
                typedData = new Float64Array(niftiImage);
            } else if (niftiHeader.datatypeCode === nifti.NIFTI1.TYPE_INT8) {
                typedData = new Int8Array(niftiImage);
            } else if (niftiHeader.datatypeCode === nifti.NIFTI1.TYPE_UINT16) {
                typedData = new Uint16Array(niftiImage);
            } else if (niftiHeader.datatypeCode === nifti.NIFTI1.TYPE_UINT32) {
                typedData = new Uint32Array(niftiImage);
            } else {
                return;
            }

            // offset to specified slice
            var sliceSize = cols * rows;
            var sliceOffset = sliceSize * slice;

            // draw pixels
            for (var row = 0; row < rows; row++) {
                var rowOffset = row * cols;

                for (var col = 0; col < cols; col++) {
                    var offset = sliceOffset + rowOffset + col;
                    var value = typedData[offset];

                    /*
                       Assumes data is 8-bit, otherwise you would need to first convert
                       to 0-255 range based on datatype range, data range (iterate through
                       data to find), or display range (cal_min/max).

                       Other things to take into consideration:
                         - data scale: scl_slope and scl_inter, apply to raw value before
                           applying display range
                         - orientation: displays in raw orientation, see nifti orientation
                           info for how to orient data
                         - assumes voxel shape (pixDims) is isometric, if not, you'll need
                           to apply transform to the canvas
                         - byte order: see littleEndian flag
                    */
                    canvasImageData.data[(rowOffset + col) * 4] = value & 0xFF;
                    canvasImageData.data[(rowOffset + col) * 4 + 1] = value & 0xFF;
                    canvasImageData.data[(rowOffset + col) * 4 + 2] = value & 0xFF;
                    canvasImageData.data[(rowOffset + col) * 4 + 3] = 0xFF;
                }
            }

            ctx.putImageData(canvasImageData, 0, 0);
        }

        function makeSlice(file, start, length) {
            var fileType = (typeof File);

            if (fileType === 'undefined') {
                return function () {};
            }

            if (File.prototype.slice) {
                return file.slice(start, start + length);
            }

            if (File.prototype.mozSlice) {
                return file.mozSlice(start, length);
            }

            if (File.prototype.webkitSlice) {
                return file.webkitSlice(start, length);
            }

            return null;
        }

        function readFile(file) {
            var blob = makeSlice(file, 0, file.size);

            var reader = new FileReader();

            reader.onloadend = function (evt) {
                if (evt.target.readyState === FileReader.DONE) {
                    readNIFTI(file.name, evt.target.result);
                }
            };

            reader.readAsArrayBuffer(blob);
        }

        function handleFileSelect(evt) {

            window.alert(typeof evt);
            var files = evt.target.files;
            window.alert(typeof files);
            readFile(files[0]);
        }
    </script>

    <title>NIFTI-Reader-JS Test</title>
        <style>
        a.sign_up {
            position: absolute;
            top: 30px;
            right: 90px;
            z-index: 2;
            font-size:20px;
            border-radius:0.12em;
            box-sizing: border-box;
            font-family:georgia;
            font-weight: bold;
            font-weight: 400;
            padding:0.35em 1.2em;
            color:#000000;
            transition: all 0.2s;
            text-decoration:none;

        }


        </style>
</head>

<body>

<div id="select" style="font-family:sans-serif">
    <?php echo "<a class = 'sign_up' href='logout.php'> Logout " . $_SESSION['username'] . "</a>"; ?>
    <a class='sign_up' style='top:70px' href='welcome.php'> Back</a>
    

    <form action="" method="post">
      <p>Select a file: <input type="file" id="file" name="files" /></p>
    <input type="text" name="search">
    <input type="submit" name="submit" value="Search">



    </form>
    <hr />
</div>

<div id="results">
<div> vistualization tool</div>
    <canvas id="myCanvas" width="100" height="100"></canvas><br />
    <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
</div>

<script type="text/javascript">
    document.getElementById('file').addEventListener('change', handleFileSelect, false);
</script>
<p id="demo"></p>
</body>

</html>