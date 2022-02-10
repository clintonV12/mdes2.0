<?php require_once("includes/upper.php"); ?>

    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Operations and Procedures</h5>
                                    <span>Please indicate with a Yes/No if you have had any of the following operations and procedures</span>
                                </div>
                                <div class="card-block">
                                    <form class="form-material" action=".?action=<?php echo $results['operationFormAction']?>" method="post">
                                        <input type="hidden" name="userid" value="<?= $_SESSION['user_id']; ?>" />
                                        <div class="row col-md-12">
                                            <div class="form-group form-default col-md-4">
                                                <p class="m-0"><b>1. Vaccination</b></p>
                                                <input type="radio" name="vaccination" value="Yes" required <?php if($medHistoryIsSet && $results['operation']->vaccination =="Yes"){echo "checked=checked";} ?>>
                                                <label for="urge">Yes</label>
                                                <input type="radio" name="vaccination" value="No" required <?php if($medHistoryIsSet && $results['operation']->vaccination =="No"){echo "checked=checked";} ?>>
                                                <label for="urge">No</label>
                                            </div>

                                            <div class="form-group form-default col-md-4">
                                                <p class="m-0"><b>2. Back surgery</b></p>
                                                <input type="radio" name="back_surgery" value="Yes" required <?php if($medHistoryIsSet && $results['operation']->back_surgery =="Yes"){echo "checked=checked";} ?>>
                                                <label for="urge">Yes</label>
                                                <input type="radio" name="back_surgery" value="No" required <?php if($medHistoryIsSet && $results['operation']->back_surgery =="No"){echo "checked=checked";} ?>>
                                                <label for="urge">No</label>
                                            </div>

                                            <div class="form-group form-default col-md-4">
                                                <p class="m-0"><b>3. Thyroid</b></p>
                                                <input type="radio" name="thyroid" value="Yes" required <?php if($medHistoryIsSet && $results['operation']->thyroid =="Yes"){echo "checked=checked";} ?>>
                                                <label for="urge">Yes</label>
                                                <input type="radio" name="thyroid" value="No" required <?php if($medHistoryIsSet && $results['operation']->thyroid =="No"){echo "checked=checked";} ?>>
                                                <label for="urge">No</label>
                                            </div>
                                        </div><hr>

                                        <div class="row col-md-12">
                                            <div class="form-group form-default col-md-4">
                                                <p class="m-0"><b>4. Appendectomy</b></p>
                                                <input type="radio" name="appendectomy" value="Yes" required <?php if($medHistoryIsSet && $results['operation']->appendectomy =="Yes"){echo "checked=checked";} ?>>
                                                <label for="urge">Yes</label>
                                                <input type="radio" name="appendectomy" value="No" required <?php if($medHistoryIsSet && $results['operation']->appendectomy =="No"){echo "checked=checked";} ?>>
                                                <label for="urge">No</label>
                                            </div>

                                            <div class="form-group form-default col-md-4">
                                                <p class="m-0"><b>5. Tonsillectomy</b></p>
                                                <input type="radio" name="tonsillectomy" value="Yes" required <?php if($medHistoryIsSet && $results['operation']->tonsillectomy =="Yes"){echo "checked=checked";} ?>>
                                                <label for="urge">Yes</label>
                                                <input type="radio" name="tonsillectomy" value="No" required <?php if($medHistoryIsSet && $results['operation']->tonsillectomy =="No"){echo "checked=checked";} ?>>
                                                <label for="urge">No</label>
                                            </div>

                                            <div class="form-group form-default col-md-4">
                                                <p class="m-0"><b>6. Sinus</b></p>
                                                <input type="radio" name="sinus" value="Yes" required <?php if($medHistoryIsSet && $results['operation']->sinus =="Yes"){echo "checked=checked";} ?>>
                                                <label for="urge">Yes</label>
                                                <input type="radio" name="sinus" value="No" required <?php if($medHistoryIsSet && $results['operation']->sinus =="No"){echo "checked=checked";} ?>>
                                                <label for="urge">No</label>
                                            </div>
                                        </div><hr>

                                        <div class="row col-md-12">
                                            <div class="form-group form-default col-md-4">
                                                <p class="m-0"><b>7. Stomach</b></p>
                                                <input type="radio" name="stomach" value="Yes" required <?php if($medHistoryIsSet && $results['operation']->stomach =="Yes"){echo "checked=checked";} ?>>
                                                <label for="urge">Yes</label>
                                                <input type="radio" name="stomach" value="No" required <?php if($medHistoryIsSet && $results['operation']->stomach =="No"){echo "checked=checked";} ?>>
                                                <label for="urge">No</label>
                                            </div>

                                            <div class="form-group form-default col-md-4">
                                                <p class="m-0"><b>8. Female/Male organs</b></p>
                                                <input type="radio" name="male_female_organs" value="Yes" required <?php if($medHistoryIsSet && $results['operation']->male_female_organs =="Yes"){echo "checked=checked";} ?>>
                                                <label for="urge">Yes</label>
                                                <input type="radio" name="male_female_organs" value="No" required <?php if($medHistoryIsSet && $results['operation']->male_female_organs =="No"){echo "checked=checked";} ?>>
                                                <label for="urge">No</label>
                                            </div>

                                            <div class="form-group form-default col-md-4">
                                                <p class="m-0"><b>9. Gall Bladder</b></p>
                                                <input type="radio" name="gall_bladder" value="Yes" required <?php if($medHistoryIsSet && $results['operation']->gall_bladder =="Yes"){echo "checked=checked";} ?>>
                                                <label for="urge">Yes</label>
                                                <input type="radio" name="gall_bladder" value="No" required <?php if($medHistoryIsSet && $results['operation']->gall_bladder =="No"){echo "checked=checked";} ?>>
                                                <label for="urge">No</label>
                                            </div>
                                        </div><hr>

                                        <div class="row col-md-12">
                                            <div class="form-group form-default col-md-4">
                                                <p class="m-0"><b>10. Hernia</b></p>
                                                <input type="radio" name="hernia" value="Yes" required <?php if($medHistoryIsSet && $results['operation']->hernia =="Yes"){echo "checked=checked";} ?>>
                                                <label for="urge">Yes</label>
                                                <input type="radio" name="hernia" value="No" required <?php if($medHistoryIsSet && $results['operation']->hernia =="No"){echo "checked=checked";} ?>>
                                                <label for="urge">No</label>
                                            </div>

                                            <div class="form-group form-default col-md-4">
                                                <p class="m-0"><b>11. Tubes in ears</b></p>
                                                <input type="radio" name="tubes_in_ears" value="Yes" required <?php if($medHistoryIsSet && $results['operation']->tubes_in_ears =="Yes"){echo "checked=checked";} ?>>
                                                <label for="urge">Yes</label>
                                                <input type="radio" name="tubes_in_ears" value="No" required <?php if($medHistoryIsSet && $results['operation']->tubes_in_ears =="No"){echo "checked=checked";} ?>>
                                                <label for="urge">No</label>
                                            </div>

                                            <div class="form-group form-default col-md-4">
                                                <p class="m-0"><b>12. Rectal Surgery</b></p>
                                                <input type="radio" name="rectal_surgery" value="Yes" required <?php if($medHistoryIsSet && $results['operation']->rectal_surgery =="Yes"){echo "checked=checked";} ?>>
                                                <label for="urge">Yes</label>
                                                <input type="radio" name="rectal_surgery" value="No" required <?php if($medHistoryIsSet && $results['operation']->rectal_surgery =="No"){echo "checked=checked";} ?>>
                                                <label for="urge">No</label>
                                            </div>
                                        </div><hr>

                                        <div class="form-group form-default">
                                        <input type="submit" name="saveChanges" value="Save" class="btn waves-effect waves-light btn-primary btn-outline-primary btn-block">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>List of current medications</h5>
                                    <span>Please list all medications you are currently taking. Separate them using a comma.</span>
                                </div>
                                <div class="card-block">
                                    <form class="form-material" action=".?action=<?php echo $results['medsFormAction']?>" method="post">
                                        <input type="hidden" name="userid" value="<?= $_SESSION['user_id']; ?>" />
                                        
                                        <div class="form-group form-default">
                                            <textarea name="list_of_meds" class="form-control" required=""><?php if($medIsSet){echo $results['meds']->list_of_meds;} ?></textarea>
                                            <span class="form-bar"></span>
                                            <label class="float-label">List of current medications</label>
                                        </div>

                                        <div class="form-group form-default">
                                            <button type="submit" name="saveChanges" value="saveChanges" class="btn waves-effect waves-light btn-primary btn-outline-primary btn-block">
                                                Save 
                                            </button>
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