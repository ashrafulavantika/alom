<?php
session_name("AIPL_session");
session_start();
session_id(123);
//echo "<br>My session_name : ". session_name();
//echo "<br>My session_id : ". session_id();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "session_token : ".$_SESSION['csrf_time']." : ".$_SESSION['csrf_token'];
    echo "<br>form_token : ".time()." : ".$_POST['csrf_token']."<br><br><br>";
    
    if($_SESSION['csrf_token'] == $_POST['csrf_token']) {
        unset($_SESSION['csrf_token']);
        if (time() <= $_SESSION['csrf_time']) {
            unset($_SESSION['csrf_token']);
            unset($_SESSION['csrf_time']);
            $name = $_POST['name'];
            $mobile = $_POST['mobile'];
            echo "Matched : ".$name.", ".$mobile;
        } else {
            echo '<a href="javascript:window.history.back()">Token does not matched</a>';
        }//End of if else  
    } else {
        echo '<a href="javascript:window.history.back()">Token does not matched</a>';
    }//End of if else    
} else {
    //$_SESSION['csrf_token'] = base64_encode(openssl_random_pseudo_bytes(32));
    $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(24));    
    $_SESSION['csrf_time'] = time() + 60*10; //in seconds
}//End of if else ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>CSRF Token Example</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="text-center">
        <form action="csrf.php" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header bg-dark text-white">Form</div>
                <div class="card-body">
                    <input type="text" name="csrf_token" value="<?=$_SESSION['csrf_token']?>" class="form-control">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="title">Name :</label>
                            <input class="form-control" type="text" name="name" />
                        </div>
                        <div class="col-md-6">
                            <label for="title">Mobile :</label>
                            <input class="form-control" type="text" name="mobile" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button class="btn btn-success" style="margin-top: 20px;" type="submit">Submit</button>
                        </div>
                    </div><!-- End of .row -->
                </div><!-- End of .card-body-->
            </div><!--End of .card -->
        </form>
    </body>
</html>