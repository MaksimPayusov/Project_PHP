<?php
session_start();
include('../includes/config.php');
if(strlen($_SESSION['tclogin'])==0)
    {   
		header('location:index.php');
	}
	else
	{
	if(isset($_POST['submit']))
	{
		$id_=$_POST['id_'];
		$status = $_POST['status']; 
		if ($status == "В работе") {
			$ret=mysqli_query($con,"update `requests` set `status`='$status', updationDate=now(),startDate=now() where id='$id_'");
		} 
		
		if ($status == "Завершена") {
			mysqli_query($con,"update `requests` set `status`='$status',updationDate=now(), endDate=now() where id='$id_'");
			$result1 = mysqli_query($con,"SELECT startDate,endDate FROM `requests` where id='$id_' ");
			$row1 = mysqli_fetch_assoc($result1);
			
			//------------------------------------------
			$date1 = new DateTime("".$row1["startDate"]."");
			$date2 = new DateTime("".$row1["endDate"]."");
			
			$diff = $date2->diff($date1);
			$hours = $diff->h;
			$hours = $hours + ($diff->days*24);
		
		//------------------------------------------
			$ret=mysqli_query($con,"update `requests` set `times`='$hours' where id='$id_'");
		}
		if($ret)
		{
			$_SESSION['msg']="Статус задачи назначена!";
		}
		else
		{
		  $_SESSION['msg']="Ошибка : Статус задачи не назначена.";
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
    <title>Задачи</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
</head>
<body>
	<?php include('includes/header.php');?>
    <!-- LOGO HEADER END-->
	<?php if($_SESSION['tclogin']!="")
	{
	 include('includes/menubar.php');
	} ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Назначение статуса задачи </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           Задачи
                        </div>
						<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
                        <div class="panel-body">
                       <form name="level" method="post">
					    <div class="form-group">
								<label for="students">Выбор задачи </label>
								<select class="form-control" name="id_" required="required">
							   <option value="">Выберите задачи</option>   
							   <?php 
							$id_ = $_SESSION['id'];
							$sql=mysqli_query($con,"select * from requests WHERE id_technic = '$id_'");
							while($row=mysqli_fetch_array($sql))
							{
							?>
							<option value="<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['name']);?></option>
							<?php } ?>
							</select> 
						  </div> 
						   <div class="form-group">
							<label for="students">Выбор статуса </label>
							<select class="form-control" name="status" required="required">
							<option value="">Установите статус</option>   
							<option value="В работе">В работе</option>
							<option value="Завершена">Завершена</option>
							</select> 
						  </div> 
						  
						 <button type="submit" name="submit" class="btn btn-default">Сохранить</button>
						</form>
                            </div>
                            </div>
                    </div>
                  
                </div>
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Управление задачами
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Задача</th>
											<th>Сообщение</th>
											<th>Статус</th>
                                            <th>Дата создания</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
										$id_ = $_SESSION['id'];
										$sql=mysqli_query($con,"select * from requests WHERE id_technic = '$id_'");
										$cnt=1;
										while($row=mysqli_fetch_array($sql))
										{ ?>
                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['name']);?></td>
											<td><?php echo htmlentities($row['descruption']);?></td>
											<td><?php echo htmlentities($row['status']);?></td>
                                            <td><?php echo htmlentities($row['creationDate']);?></td>
                                        </tr>
										<?php 
										$cnt++;
										} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     <!--  End  Bordered Table  -->
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="../assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="../assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
