
<?php require_once("includes/upper.php"); ?>

    <div class="pcoded-inner-content">
    
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="page-body breadcrumb-page">
                        <div class="card borderless-card">
                            <div class="card-block danger-breadcrumb">
                                <div class="breadcrumb-header">
                                    <h5>From your family history you might be at risk of:</h5>
                                </div>
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="#!">
                                                <i class="icofont icofont-home"></i>
                                            </a>
                                        </li>
                                        <?php foreach($arr1 as $arr): ?>
                                            <li class="breadcrumb-item"><a href="#!"><?=$arr?></a></li>
                                        <?php endforeach;?>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="card-block">
                    <!-- Button to Open the Modal -->
                    <button class="btn waves-effect waves-light btn-grd-primary" data-toggle="modal" data-target="#myModal" onclick="showNextQ()">
                        Start diagnosis
                    </button>
                    </div><br>
                    


                    

                    <!-- The Modal -->
                    <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Symptoms (<b id="cn">1</b>/<b><?=count($symptoms);?>)</b></h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <p>Please indicate with Yes/No if you are experiancing any of these symptoms.</p>
                                <h4 id="question"></h4>
                                <form action="index.php" method="post">
                                    <input name="" id="yes_label" type="radio" value="Yes">
                                    <label for="yes_label">Yes</label>

                                    <input name="" id="no_label" type="radio" value="No">
                                    <label for="no_label">No</label>
                                    <input type="hidden" name="diagnosis-resp" value="Default">
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger" data-dismiss="m3odal" onclick="showNextQ()">Continue</button>
                            </div>

                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Insert Clues</h5>
                                    <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
                                </div>
                                <div class="card-block">
                                    <form class="form-material">
                                        
                                        <div class="form-group form-default">
                                            <textarea class="form-control" required=""></textarea>
                                            <span class="form-bar"></span>
                                            <label class="float-label">Symptom input</label>
                                            <ol>
                                                <?php foreach($symptoms as $sym): ?>
                                                    <?php if(is_numeric($sym)){continue;} ?>
                                                    <li><?php echo $sym; ?></li>
                                                <?php endforeach;?>
                                            </ol>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Possible Diagnosis</h5>
                                    <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
                                </div>
                                <div class="card-block">
                                    <form class="form-material">
                                        <ol>
                                            <?php foreach($illness as $ill): ?>
                                                <?php if(is_numeric($ill)){continue;} ?>
                                                <li><?php echo $ill; ?></li>
                                            <?php endforeach;?>
                                        </ol>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Risk Factor</h5>
                                    <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
                                </div>
                                <div class="card-block">
                                    <form class="form-material">
                                        <ol>
                                            <?php foreach($risks as $risk): ?>
                                                <?php if(is_numeric($risk)){continue;} ?>
                                                <li><?php echo $risk; ?></li>
                                            <?php endforeach;?>
                                        </ol>
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

    <script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script>
       var count = 0;
       function showNextQ(){
            count = count + 1;
            var que = <?php echo json_encode($symptoms); ?>;
            
            var q_display = que[count].replace(/_/g, ' ');
            q_display = q_display.charAt(0).toUpperCase() + q_display.slice(1);

            document.getElementById("cn").innerHTML = count;
            document.getElementById("question").innerHTML = q_display;
            document.getElementById("yes_label").setAttribute("name",que[count]);
            document.getElementById("no_label").setAttribute("name",que[count]);
            
            document.getElementById("yes_label").checked = false;
            document.getElementById("no_label").checked = false;
       }
    </script>

<?php require_once("includes/lower.php"); 
?>