
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

                    
                    
                    <!-- TODO:: collect user data-->
                    

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
                                <form action="" method="post">
                                    <input name="" id="yes_label" type="radio" value="Yes">
                                    <label for="yes_label">Yes</label>

                                    <input name="" id="no_label" type="radio" value="No">
                                    <label for="no_label">No</label>
                                    <input type="hidden" name="diagnosis-resp" value="Default">
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" id="contBtn" data-dismiss="m3odal" onclick="showNextQ('default')">Continue</button>
                                <button type="button" class="btn btn-danger" data-dismiss="m3odal" onclick="sendData()">Finish</button>
                            </div>

                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card" id="c1">
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
                                            
                                            <button class="btn waves-effect waves-light btn-grd-secondary border border-primary" style="width:100%">
                                                Submit
                                            </button>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card" id="c2">
                                <div class="card-header">
                                    <h5>Possible Diagnosis</h5>
                                    <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
                                </div>
                                <div class="card-block">
                                    <form class="form-material">
                                        <ol id="possible_diagnosis">
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
                            <div class="card" id="c3">
                                <div class="card-header">
                                    <h5>Risk Factor</h5>
                                    <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
                                </div>
                                <div class="card-block">
                                    <form class="form-material">
                                        <ol id="risk_factor">
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

                    <div class="card-block">
                    <!-- Button to Open the Modal -->
                        <button style="width:100%" class="btn waves-effect waves-light btn-grd-primary" data-toggle="modal" data-target="#myModal" onclick="showQModal()">
                            Get Detailed Diagnosis
                        </button>
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

       setHeight();
       var count = 0;
       var x = new Object();
       var que = <?php echo json_encode($symptoms); ?>;

       function showNextQ(param = null){
           if(count < que.length){
                
                if(document.getElementById("yes_label").checked == true){
                    x[count]= que[count]+">Yes";
                }
                if(document.getElementById("no_label").checked == true){
                    x[count-1]= que[count-1]+">No";
                }

                document.getElementById("yes_label").checked = false;
                document.getElementById("no_label").checked = false;
                //check if value is not null
                if(!!param){
                    count = count + 1;
                }

                var q_display = null;
                try {
                    q_display = que[count].replace(/_/g, ' ');
                    q_display = q_display.charAt(0).toUpperCase() + q_display.slice(1);
                } catch (error) {
                    console.error(error);
                }
                

                document.getElementById("cn").innerHTML = count+1;
                document.getElementById("question").innerHTML = q_display;
                document.getElementById("yes_label").setAttribute("name",que[count]);
                document.getElementById("no_label").setAttribute("name",que[count]);
                
            }
       }

       function showQModal(){
           var count = 0;

            var q_display = null;
            try {
                q_display = que[count].replace(/_/g, ' ');
                q_display = q_display.charAt(0).toUpperCase() + q_display.slice(1);
            } catch (error) {
                console.error(count);
                console.error(que[count]);
                console.error(error);
            }
            

            document.getElementById("cn").innerHTML = count+1;
            document.getElementById("question").innerHTML = q_display;
            document.getElementById("yes_label").setAttribute("name",que[count]);
            document.getElementById("no_label").setAttribute("name",que[count]);
            
       }


       function sendData(){
           
           $(function () {
                $('#myModal').modal('toggle');
            });

           var jsonString = JSON.stringify(x);
            $.ajax({
                    type: "POST",
                    url: "index.php?action=diagnosis-reponse",
                    data: {data : jsonString}, 
                    cache: false,

                    success: function(response){
                        var obj = JSON.parse(response);
                        
                        var list = document.getElementById("possible_diagnosis");
                        var list2 = document.getElementById("risk_factor");

                        list.innerHTML = "";
                        list2.innerHTML = "";

                        obj.forEach((item)=>{
                            const myArray = item.split("=");

                            var li = document.createElement("li");
                            li.innerText = myArray[0];
                            list.appendChild(li);

                            var li = document.createElement("li");
                            li.innerText = myArray[1];
                            list2.appendChild(li);
                        });
                    }
            });
        }

        function setHeight(){
            
            var offsetHeight = document.getElementById('c2').offsetHeight;
            document.getElementById('c1').style.height = offsetHeight+'px';
            console.log(offsetHeight);
        }

    </script>

<?php require_once("includes/lower.php"); 
?>