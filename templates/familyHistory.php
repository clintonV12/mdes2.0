<?php require_once("includes/upper.php"); ?>

    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Material tab card start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Diseases and conditions that can run in the family include the following</h5>
                                    <p>Please indicate with a Yes/No if any of these run in your family</p>
                                </div>
                                
                                <div class="card-block">
                                    <!-- Row start -->
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xl-12">
                                            <form action=".?action=<?php echo $results['formAction']?>" method="post">
                                                <input type="hidden" name="userid" value="<?= $_SESSION['user_id']; ?>" />
                                                <div class="row col-md-12">
                                                    <div class="form-group form-default col-md-6">
                                                        <p class="m-0"><b>1. Asthma</b></p>
                                                        <input type="radio" name="asthma" value="Yes" required <?php if($historyIsSet && $results['history']->asthma =="Yes"){echo "checked=checked";} ?>>
                                                        <label for="urge">Yes</label>
                                                        <input type="radio" name="asthma" value="No" required <?php if($historyIsSet && $results['history']->asthma =="No"){echo "checked=checked";} ?>>
                                                        <label for="urge">No</label>
                                                    </div>

                                                    <div class="form-group form-default col-md-6">
                                                        <p class="m-0"><b>2. High blood pressure</b></p>
                                                        <input type="radio" name="high_blood_pressure" value="Yes" required <?php if($historyIsSet && $results['history']->high_blood_pressure=="Yes"){echo "checked=checked";} ?>>
                                                        <label for="urge">Yes</label>
                                                        <input type="radio" name="high_blood_pressure" value="No" required <?php if($historyIsSet && $results['history']->high_blood_pressure=="No"){echo "checked=checked";} ?>>
                                                        <label for="urge">No</label>
                                                    </div>
                                                </div><hr>

                                                <div class="row col-md-12">
                                                    <div class="form-group form-default col-md-6">
                                                        <p class="m-0"><b>3. High cholesterol</b></p>
                                                        <input type="radio" name="high_cholesterol" value="Yes" required <?php if($historyIsSet && $results['history']->high_cholesterol=="Yes"){echo "checked=checked";} ?>>
                                                        <label for="urge">Yes</label>
                                                        <input type="radio" name="high_cholesterol" value="No" required <?php if($historyIsSet && $results['history']->high_cholesterol=="No"){echo "checked=checked";} ?>>
                                                        <label for="urge">No</label>
                                                    </div>

                                                    <div class="form-group form-default col-md-6">
                                                        <p class="m-0"><b>4. Stroke</b></p>
                                                        <input type="radio" name="stroke" value="Yes" required <?php if($historyIsSet && $results['history']->stroke=="Yes"){echo "checked=checked";} ?>>
                                                        <label for="urge">Yes</label>
                                                        <input type="radio" name="stroke" value="No" required <?php if($historyIsSet && $results['history']->stroke=="No"){echo "checked=checked";} ?>>
                                                        <label for="urge">No</label>
                                                    </div>
                                                </div><hr>

                                                <div class="row col-md-12">
                                                    <div class="form-group form-default col-md-6">
                                                        <p class="m-0"><b>5. Mental illness</b></p>
                                                        <input type="radio" name="mental_illness" value="Yes" required <?php if($historyIsSet && $results['history']->mental_illness=="Yes"){echo "checked=checked";} ?>>
                                                        <label for="urge">Yes</label>
                                                        <input type="radio" name="mental_illness" value="No" required <?php if($historyIsSet && $results['history']->mental_illness=="No"){echo "checked=checked";} ?>>
                                                        <label for="urge">No</label>
                                                    </div>

                                                    <div class="form-group form-default col-md-6">
                                                        <p class="m-0"><b>6. Osteoporosis</b></p>
                                                        <input type="radio" name="osteoporosis" value="Yes" required <?php if($historyIsSet && $results['history']->osteoporosis=="Yes"){echo "checked=checked";} ?>>
                                                        <label for="urge">Yes</label>
                                                        <input type="radio" name="osteoporosis" value="No" required <?php if($historyIsSet && $results['history']->osteoporosis=="No"){echo "checked=checked";} ?>>
                                                        <label for="urge">No</label>
                                                    </div>
                                                </div><hr>

                                                <div class="row col-md-12">
                                                    <div class="form-group form-default col-md-6">
                                                        <p class="m-0"><b>7. Cancer</b></p>
                                                        <input type="radio" name="cancer" value="Yes" required <?php if($historyIsSet && $results['history']->cancer=="Yes"){echo "checked=checked";} ?>>
                                                        <label for="urge">Yes</label>
                                                        <input type="radio" name="cancer" value="No" required <?php if($historyIsSet && $results['history']->cancer=="No"){echo "checked=checked";} ?>>
                                                        <label for="urge">No</label>
                                                    </div>

                                                    <div class="form-group form-default col-md-6">
                                                        <p class="m-0"><b>8. Still births</b></p>
                                                        <input type="radio" name="still_births" value="Yes" required <?php if($historyIsSet && $results['history']->still_births=="Yes"){echo "checked=checked";} ?>>
                                                        <label for="urge">Yes</label>
                                                        <input type="radio" name="still_births" value="No" required <?php if($historyIsSet && $results['history']->still_births=="No"){echo "checked=checked";} ?>>
                                                        <label for="urge">No</label>
                                                    </div>
                                                </div><hr>

                                                <div class="row col-md-12">
                                                    <div class="form-group form-default col-md-6">
                                                        <p class="m-0"><b>9. Genetic disorders</b></p>
                                                        <input type="radio" name="genetic_disorders" value="Yes" required <?php if($historyIsSet && $results['history']->genetic_disorders=="Yes"){echo "checked=checked";} ?>>
                                                        <label for="urge">Yes</label>
                                                        <input type="radio" name="genetic_disorders" value="No" required <?php if($historyIsSet && $results['history']->genetic_disorders=="No"){echo "checked=checked";} ?>>
                                                        <label for="urge">No</label>
                                                    </div>

                                                    <div class="form-group form-default col-md-6">
                                                        <p class="m-0"><b>10. Diabetes</b></p>
                                                        <input type="radio" name="diabetes" value="Yes" required <?php if($historyIsSet && $results['history']->diabetes=="Yes"){echo "checked=checked";} ?>>
                                                        <label for="urge">Yes</label>
                                                        <input type="radio" name="diabetes" value="No" required <?php if($historyIsSet && $results['history']->diabetes=="No"){echo "checked=checked";} ?>>
                                                        <label for="urge">No</label>
                                                    </div>
                                                </div><hr>

                                                <div class="form-group form-default">
                                                    <button type="submit" name="saveChanges" value="saveChanges" class="btn waves-effect waves-light btn-primary btn-outline-primary btn-block">
                                                        Submit
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Row end -->
                                </div>
                            </div>
                            <!-- Material tab card end -->
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