<?php require_once("includes/upper.php"); ?>

    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">

                        <div class="col-md-12">
                            <!-- Basic Form Inputs card start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Personal information</h5>
                                </div>
                                <div class="card-block">
                                    <h4 class="sub-title">Personal information</h4>
                                    <form action=".?action=<?php echo $results['personalFormAction']?>" method="post">
                                        <input type="hidden" name="userid" value="<?=$_SESSION['user_id']?>">

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">First name</label>
                                            <div class="col-sm-10">
                                                <input type="text" value="<?php if($profileIsSet){echo $results['profile']->firstname;} ?>" name="first_name" class="form-control"
                                                placeholder="Type your first name">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Last name</label>
                                            <div class="col-sm-10">
                                                <input type="text" value="<?php if($profileIsSet){echo $results['profile']->lastname;} ?>" name="last_name" class="form-control"
                                                placeholder="Type your last name">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="text" value="<?php if($profileIsSet){echo $results['profile']->email;} ?>" name="email" class="form-control"
                                                placeholder="Type your email address">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="number" value="<?php if($profileIsSet){echo $results['profile']->phone;} ?>" name="phone" class="form-control"
                                                placeholder="Type your phone number">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">National ID</label>
                                            <div class="col-sm-10">
                                                <input type="number" value="<?php if($profileIsSet){echo $results['profile']->nationalId;} ?>" name="national_id" class="form-control"
                                                placeholder="Type your National ID number">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Gender</label>
                                            <div class="col-sm-10">
                                                <select name="gender" class="form-control">
                                                    <option value="">Select Gender</option>
                                                    <option value="Male" <?php if($profileIsSet){if($results['profile']->gender=="Male"){echo "selected";}} ?>>Male</option>
                                                    <option value="Female" <?php if($profileIsSet){if($results['profile']->gender=="Female"){echo "selected";}} ?>>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group form-default">
                                            <button type="submit" name="saveChanges" value="saveChanges" class="btn waves-effect waves-light btn-primary btn-outline-primary btn-block">
                                                Submit
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <!-- Basic Form Inputs card end -->
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Login Credentials</h5>
                                    <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
                                </div>
                                <div class="card-block">
                                    <form class="form-material" action=".?action=<?php echo $results['passwordFormAction']?>" method="post">
                                        <div class="form-group form-default form-static-label">
                                            <input type="text" value="<?=$_SESSION['username']?>" name="username" class="form-control" placeholder="Enter User Name" required="">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Username</label>
                                        </div>
                                        <input type="hidden" name="id" value="<?= $_SESSION['user_id']?>" />
                                        
                                        <div class="form-group form-default form-static-label">
                                            <input type="password" value="" name="current_password" class="form-control" placeholder="Enter Current Password" required="">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Current Password</label>
                                        </div>

                                        <div class="form-group form-default form-static-label">
                                            <input type="password" value="" name="password" class="form-control" placeholder="Enter New Password" required="">
                                            <span class="form-bar"></span>
                                            <label class="float-label">New Password</label>
                                        </div>

                                        <div class="form-group form-default form-static-label">
                                            <input type="password" value="" name="password2" class="form-control" placeholder="Confirm Password" required="">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Confirm Password</label>
                                        </div>

                                        <div class="form-group form-default">
                                            <input type="submit" name="saveChanges" value="Save" class="btn waves-effect waves-light btn-primary btn-outline-primary btn-block">
                                              
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Page-body end -->
            </div>
            <div id="styleSelector"> </div>
        </div>
    </div>
    
<?php require_once("includes/lower.php"); 
?>