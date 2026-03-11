<?php 
session_start();

$page_title = "SignUp Form";
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert">
                    <?php 
                       if(isset($_SESSION['status']))
                        {
                          echo "<h4>".$_SESSION['status']."</h4>";
                          unset($_SESSION['status']);
                        }
                    ?>
                </div>
                <div class="card shadow">
                    <div class="card-header">
                        <h5>SignUp Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Phone Number</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Email Address</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Password</label>
                                <input type="text" name="password" class="form-control">
                            </div>
                            <!-- <div class="form-group mb-3">
                                <label for="name">Confirm Password</label>
                                <input type="text" name="confirm_password" class="form-control">
                            </div> -->
                            <div class="form-group mb-3">
                                <button type="Submit" name="signup_btn" class="btn btn-primary">SignUp Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?> 