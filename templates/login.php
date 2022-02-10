<?php require_once("includes/header.php"); ?>

	<body themebg-pattern="theme1">
        <?php require_once("includes/preloader.php") ?>

        <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    
                        <form class="md-float-material form-material" action="index.php?action=login" method="post">
                            <input type="hidden" name="login" value="true" />
                            <div class="text-center">
                                <?php if ( isset( $results['errorMessage'] ) ) { ?>
                                    <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
                                <?php } ?>
                            
                                <h2 style="color:#fff">MDES</h2>
                            </div>
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center">Sign In</h3>
                                        </div>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="text" name="username" class="form-control" required="">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Your Username</label>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="password" name="password" class="form-control" required="">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Password</label>
                                    </div>
                                    <div class="row m-t-25 text-left">
                                        <div class="col-12">
                                            <div class="checkbox-fade fade-in-primary d-">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span class="text-inverse">Remember me</span>
                                                </label>
                                            </div>
                                            <div class="forgot-phone text-right f-right">
                                                <a href=".?action=register" class="text-right f-w-600"> Don't have an account?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <input type="submit" name="login" value="Login" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20" />
                                        </div>
                                    </div>
                                    <hr/>
                                </div>
                            </div>
                        </form>
                        <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
	
<?php require_once("includes/footer.php"); ?>