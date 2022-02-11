
<?php require_once("includes/upper.php"); ?>
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">

                        <!-- Box tooltip card start -->
                        <div class="col-lg-12">
                            <div class="card o-visible">
                                <div class="card-header" style="background-color:#6d94ff;">
                                    <h5 style="color:#fff;">MEDICAL FACT</h5>
                                </div>
                                <div class="card-block" style="border:solid #3498db; margin: 10px;">
                                    
                                    <blockquote class="blockquote">
                                        <p class="m-b-0" id="word">You burn more calories sleeping than you do watching television.</p>
                                        <footer class="blockquote-footer">Source
                                            <cite title="Source Title">Unknown</cite>
                                        </footer>
                                    </blockquote>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- Box tooltip card end -->

                        <!--  project and team member start -->
                        <!--<div class="col-xl-8 col-md-12">
                            <div class="card table-card">
                                <div class="card-header">
                                    <h5>Recent Diagnosis</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                            <li><i class="fa fa-window-maximize full-card"></i></li>
                                            <li><i class="fa fa-minus minimize-card"></i></li>
                                            <li><i class="fa fa-refresh reload-card"></i></li>
                                            <li><i class="fa fa-trash close-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <div class="chk-option">
                                                        <div class="checkbox-fade fade-in-primary">
                                                            <label class="check-task">
                                                                <input type="checkbox" value="">
                                                                <span class="cr">
                                                                        <i class="cr-icon fa fa-check txt-default"></i>
                                                                    </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    Diagnosis</th>
                                                <th>Date</th>
                                                <th class="text-right">Danger</th>
                                            </tr>
                                            </thead>
                                            <?php
                                                if($numRows >= 1){
                                            ?>
                                            <tbody>
                                            
                                            <?php 
                                                $rows = $conn->getRows();
                                                foreach($rows as $row){
                                                    $illness = $row['illness'];
                                                    $date = $row['diagnosis_date'];
                                                    $danger = $row['danger'];
                                                
                                            ?>
                                            <tr>
                                                <td>
                                                    <div class="chk-option">
                                                        <div class="checkbox-fade fade-in-primary">
                                                            <label class="check-task">
                                                                <input type="checkbox" value="">
                                                                <span class="cr">
                                                                            <i class="cr-icon fa fa-check txt-default"></i>
                                                                        </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="d-inline-block align-middle">
                                                        <div class="d-inline-block">
                                                            <h6><?=$illness?></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?=date("D, d M Y", $date); ?></td>
                                                <td class="text-right">
                                                    <?php 
                                                        if($danger == "Low"){
                                                            echo "<label class='label label-success'>Low</label>";
                                                        }
                                                        elseif($danger == "Medium"){
                                                            echo "<label class='label label-warning'>Medium</label>";
                                                        }
                                                        elseif($danger == "High"){
                                                            echo "<label class='label label-danger'>High</label>";
                                                        }
                                                    ?>
                                                    
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            </tbody>
                                            <?php } ?>
                                        </table>
                                        <div class="text-right m-r-20">
                                            <a href="diagnosis.php" class=" b-b-primary text-primary">View All Reports</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-12">
                            <div class="card ">
                                <div class="card-header">
                                    <h5>Current medication</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                            <li><i class="fa fa-window-maximize full-card"></i></li>
                                            <li><i class="fa fa-minus minimize-card"></i></li>
                                            <li><i class="fa fa-refresh reload-card"></i></li>
                                            <li><i class="fa fa-trash close-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <?php
                                        if($numRows2 >= 1){
                                            $count = 0;
                                    
                                        $rows = $conn2->getRows();
                                        foreach($rows as $row){
                                            $count += 1;
                                            $drug_name = $row['drug_name'];
                                            $currently_on = $row['currently_on'];
                                            if($currently_on == "Yes"){
                                        
                                    ?>
                                    <div class="align-middle m-b-30">
                                        <div class="d-inline-block">
                                            <h6><?=$drug_name?></h6>
                                        </div>
                                    </div>
                                        <?php } } ?>
                                    <div class="text-center">
                                        <a href="help.php" class="b-b-primary text-primary">More info</a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>-->
                        <!--  project and team member end -->
                    
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
            <div id="styleSelector"> </div>
        </div>
    </div>

    <script type="text/javascript">
    var list = 
    [
        'Laughing is good for the heart and can increase blood flow by 20 percent.',
        'Your skin works hard. Not only is it the largest organ in the body, but it defends against disease and infection, regulates your temperature and aids in vitamin production.',
        'Always look on the bright side: being an optimist can help you live longer.',
        'Exercise will give you more energy, even when you’re tired.',
        'Sitting and sleeping are great in moderation, but too much can increase your chances of an early death.',
        'A lack of exercise now causes as many deaths as smoking.',
        'Between 2000 and 2015, the average global life expectancy increased by five years.',
        'Feeling stressed? Read. Getting lost in a book can lower levels of cortisol, or other unhealthy stress hormones, by 67 percent.',
        'Drinking coffee can reduce the risk of depression, especially in women.',
        'Yoga can boost your cognitive function and lowers stress.'
    ];
    var count = 0;
    var max = 9;

    setInterval(function(){ 
        document.getElementById("word").innerText = list[count];
        
        if(count == max){
            count = 0;
        }else{
            count += 1;
        }
     }, 5000);
  </script>
    
    <script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js "></script>
<script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js "></script>
<!-- waves js -->
<script src="assets/pages/waves/js/waves.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js "></script>
<!-- waves js -->
<script src="assets/pages/waves/js/waves.min.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="assets/js/SmoothScroll.js"></script>
<script src="assets/js/jquery.mCustomScrollbar.concat.min.js "></script>

<!-- Custom js -->
<script src="assets/js/morris-custom-chart.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<script src="assets/js/vertical-layout.min.js "></script>
<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="assets/js/script.js"></script>
</body>

</html>
