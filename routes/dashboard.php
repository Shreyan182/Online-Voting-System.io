<?php
    session_start();
    if(!isset($_SESSION['userdata'])){
        header("location: ../");
    }
    $userdata = $_SESSION['userdata'];
    $groupsdata = $_SESSION['groupsdata'];

    if($_SESSION['userdata']['status']==0){
        $status = '<b style="color:red">Not Voted</b>';
    }
    else{
        $status = '<b style="color:green">Voted</b>';
    }

?>


<html>
    <head>
        <title>Online Voting System-Dashboard</title>
        <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    </head>
    <body>
        <style>
            #backbtn{
                padding:5px;
                margin:10px;
                font-size: 15px;
                background-color: rgb(119, 0, 0);
                color: white;
                border-radius: 5px;
                float: left;
            }
            #logoutbtn{
                padding:10px;
                margin:10px;
                background-color: rgb(221, 49, 49);
                color: white;
                border-radius: 5px;
                float: right;
            }
            #Profile{
                text-align: left;
                background-color: #ffcbcb;
                width: 30%;
                padding: 20px;
                margin: 10px;
                float: left;
                border-radius: 10px;
            }
            #headerSection{
                background-color: #430f58;
                color: #f0d43a;
            }
            #Group{
                text-align: left;
                background-color:#eda045; 
;
                width: 60%;
                padding: 20px;
                margin: 10px;
                float: right;
                border-radius: 10px;
            }
            #votebtn{
                padding:5px;
                font-size: 15px;
                background-color: green;
                color: white;
                border-radius: 5px;
                float: left;;
            }
            #mainSection{
                
            }
            #voted{
                padding:5px;
                font-size: 15px;
                background-color: #11144c;
                color: white;
                border-radius: 5px;
                float: left;;
            }
            img{
                border-radius: 100%;
            }
           
        </style>
        <div id="mainSection">
            <div id="headerSection">
                <a href="../"><button id="backbtn"> Back</button></a>
                <a href="logout.php"><button id="logoutbtn"> Logout</button></a>
                <h1>Online Voting System</h1>
            </div>
            <hr>
            <div>
        </div>
            <div id="Profile">
                <center><img src="../uploads/<?php echo $userdata['photo']?>" height="150" width="150"><br><br></center>
                <b>Name:</b>&nbsp;<?php echo $userdata['name']?><br><br>
                <b>Mobile:</b>&nbsp;<?php echo $userdata['mobile']?><br><br>
                <b>Address:</b>&nbsp;<?php echo $userdata['address']?><br><br>
                <b>Status:</b>&nbsp;<?php echo $status?><br><br>
            </div>
            <div id="Group">
                <?php
                    if($_SESSION['groupsdata']){
                        for($i= 0;$i<count($groupsdata);$i++){
                            ?>
                            <div>
                                <img style="float: right" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" height="100" width="100">
                                <b>Group Name: </b><?php echo $groupsdata[$i]['name'] ?><br><br>
                                <?php
                                        if($_SESSION['userdata']['status']==0){
                                            ?>
                                            <b>Votes: </b>Hidden<br><br> 
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <b>Votes: </b><?php echo $groupsdata[$i]['votes']?><br><br> 
                                            <?php
                                        }
                                    ?>
                                <form action="../api/vote.php" method="post">
                                    <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
                                    <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">
                                    <?php
                                        if($_SESSION['userdata']['status']==0){
                                            ?>
                                            <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <button disabled type="button" name="votebtn" value="Vote" id="voted">Voted</button>
                                            <?php
                                        }
                                    ?>
                                </form>
                            </div>
                            <br>
                            <hr>
                            <?php
                        }
                    }
                    else{

                    }
                ?>
            </div>
        </div>

    </body>
</html>