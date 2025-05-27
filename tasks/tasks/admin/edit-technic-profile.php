<?php
session_start();
include('../includes/config.php');
error_reporting(0);
if(strlen($_SESSION['alogin'])==0)
    {   
		header('location:index.php');
	}
	else 
	{
		if(isset($_POST['submit']))
		{
			  $regid=intval($_GET['id']);
			  $username=$_POST['username'];
			  $fio=$_POST['fio'];
			$ret=mysqli_query($con,"update technic set username='$username',fio='$fio',updationDate=now()  where id='$regid'");
			if($ret)
			{
				echo '<script>alert("Запись работника успешно обновлена!")</script>';
				echo '<script>window.location.href=manage-technic.php</script>';
			}else{
				echo '<script>alert("Ошибка: Запись не обновляется.")</script>';
				echo '<script>window.location.href=manage-technic.php</script>';
			}
		}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Профиль работника</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
</head>
<body>
	<?php include('includes/header.php');?>
		<!-- LOGO HEADER END-->
	<?php if($_SESSION['alogin']!="")
	{
	 include('includes/menubar.php');
	} ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Редактирование профиля работника  </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          Редактирование работника
                        </div>
							<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
							<?php 
							$regid=intval($_GET['id']);
							$sql=mysqli_query($con,"select * from technic where id='$regid'");
							$cnt=1;
							while($row=mysqli_fetch_array($sql))
							{ ?>
							<div class="panel-body">
							  <form name="dept" method="post" enctype="multipart/form-data">
							   <div class="form-group">
								<label for="studentregno">Логин работника   </label>
								<input type="text" class="form-control" id="username" name="username" value="<?php echo htmlentities($row['username']);?>"  placeholder="Логин" />
							   </div>
							   
							   <div class="form-group">
								<label for="studentname">ФИО работника  </label>
								<input type="text" class="form-control" id="fio" name="fio" value="<?php echo htmlentities($row['fio']);?>"  />
							  </div>
							  <?php } ?>
							 <button type="submit" name="submit" id="submit" class="btn btn-default">Обновить</button>
							</form>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php include('includes/footer.php');?>
    <script src="../assets/js/jquery-1.11.1.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
