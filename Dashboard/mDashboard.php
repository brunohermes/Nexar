<?php

    include_once('../includes/config.php');
    include_once('master.php');
    $logado = $_SESSION['email'];
    
    $sql2 = "SELECT * FROM users WHERE email = '$logado'";
    $resulto = $conexao->query($sql2);
    $user_data = mysqli_fetch_assoc($resulto);

    $fn = $user_data['firstname']." ".$user_data['lastname'];
    $usrname = $user_data['firstname'];
    //custom profile 
    function getProfilePicture($name){
        $name_slice = explode(' ',$name);
          $name_slice = array_filter($name_slice);
          $initials = '';
        $initials .= (isset($name_slice[0][0]))?strtoupper($name_slice[0][0]):'';
        $initials .= (isset($name_slice[count($name_slice)-1][0]))?strtoupper($name_slice[count($name_slice)-1][0]):'';
        return '<div class="profile-pic">'.$initials.'</div>';
    }
    $page_title = "Dashboard";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="internals/dashboard-design.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="jQuery.js"></script> 
    <title>Dashboard</title>
</head>
<body>
    <p class="dashboardTitle">Dashboard</p>
    <p class="wlcmTitle">Welcome back, <?php echo $fn; ?>!</p>
    <hr class="line">   
    <div class="page-handlr">
        <div class="datausage">
        <p class="numberP">Total Projects: <?php echo $nop['projects']; ?></p>
        <canvas id="projectsChart"></canvas>
        <script>
            const ctx = document.getElementById('projectsChart').getContext('2d');
            const totalPlan = 20;
            const usedTotal = <?php echo $nop['projects']; ?>;
            const myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        fill: true,
                        backgroundColor: 'rgba(91, 154, 255, 0.2',
                        data: [usedTotal, (totalPlan-usedTotal)  ],
                        backgroundColor: [
                            'rgba(245, 245, 245, 1)',
                            'rgba(25, 25, 25, 1)'
                        ],
                        borderColor: [
                            'rgba(245, 245, 245, 1)',
                            'rgba(245, 245, 245, 0)'
                        ],
                        borderWidth: 1,
                        cutout: '93%', 
                        circumference: 180,
                        rotation: 270,
                        borderRadius: 5,

                    }],
                        
                    },
                    options: {
        plugins: {
            title: {
                display: true,
                text: 'Used Total: ' + (usedTotal/totalPlan)*100 + '%',
                align: 'center',
                position: 'bottom',
                fullsize: 'true',
                font: {
                        size: 15,
                        family: 'Helvetica',
                    },
                padding: {
                    bottom: 50
                }
            }
        }
    }
            });
            </script>
        </div>
        <hr class="line">
        <p class="projectsTitle">Your projects:</p> 
        <div class="modelviewer">
            <div class="projectlist">
                <nav>
                <?php 
                        $sql3 = "SELECT * FROM projects WHERE uid = '$uid'";
                        $resulta = $conexao->query($sql3);
                        
                        if ($resulta->num_rows != 0) {
                            echo "<ul  name='projectselection'>";
                            // output data of each row
                            while($row = mysqli_fetch_array($resulta, MYSQLI_ASSOC)) {
                                $projpath = $row['projectpath'];
                                $projname = $row['projectname'];
                                
                                $html = <<< EOD
                                <center><embed id="emb" class="viewmodule" src="{$projpath}"></embed></center>
                                <a  href="{$projpath}" onclick="document.getElementById('emb').src='{$projpath}'"><li class="listofprojects" value="{$projname}">{$projname}</li></a> 
                                <hr class="line">
                                EOD;
                              echo $html;
                //  "<a id='projectref' href='". $row['projectpath'] . "' >" ."<li class='listofprojects' value='" . $row['projectname'] . "'>" .  $row['projectname']  ."</li>". "</a>"; 
                            }
                            echo "</ul>";
                        } 
                        ?>
                     </nav>
            </div>
        
    </div>
</body>
</html>