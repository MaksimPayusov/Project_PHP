<?php
session_start();
include('../includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
		header('location:index.php');
	}
	else 
	{
	if(isset($_POST['submit']))
	{
		$name=$_POST['name'];
		$descruption=$_POST['descruption'];
		$clients=$_POST['clients'];
		$id_technic=$_POST['id_technic'];
		$ret=mysqli_query($con,"insert into requests(name,descruption,clients,id_technic) values('$name','$descruption','$clients','$id_technic')");
		if($ret)
		{
			$_SESSION['msg']="Задача успешно добавлена!";
		} else {
			$_SESSION['delmsg']="Ошибка : Не добавлена.";
		}
	}
	if(isset($_GET['del']))
		  {
			mysqli_query($con,"delete from requests where id = '".$_GET['id']."'");
			$_SESSION['delmsg']="Задача удалена!";
		  }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Панель администратора | Задачи</title>
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
                        <h1 class="page-head-line">Операции с задачами</h1>
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
							<font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                        <div class="panel-body">
                       <form name="level" method="post">
						   <label>Введите название задачи: </label>
							<input type="text" name="name" class="form-control" required />
							<label>Введите заказчика: </label>
							<input type="text" name="clients" class="form-control" required />
							<label>Введите сообщение:  </label>
							<textarea class="form-control" id="descruption" name="descruption" placeholder="Сообщение" required></textarea>
							  <div class="form-group">
									<label for="students">Выбор работника для задачи</label>
									<select class="form-control" name="id_technic" required="required">
								   <option value="">Выберите работника</option>   
								   <?php 
								$sql=mysqli_query($con,"select * from technic");
								while($row=mysqli_fetch_array($sql))
								{
								?>
								<option value="<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['fio']);?></option>
								<?php } ?>
								</select> 
							  </div> 				  
							 <button type="submit" name="submit" class="btn btn-default">Добавить</button>
						</form>
                       </div>
                      </div>
                    </div>
                </div>
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
                                            <th>Название задачи</th>
											<th>Заказчик</th>
											<th>Сообщение</th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
										$sql=mysqli_query($con,"select * from requests");
										$cnt=1;
										while($row=mysqli_fetch_array($sql))
										{ ?>
                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['name']);?></td>
											<td><?php echo htmlentities($row['clients']);?></td>
                                            <td><?php echo htmlentities($row['descruption']);?></td>
                                            <td>
											 <a href="edit-requests.php?id=<?php echo $row['id']?>">
												<button class="btn btn-primary"><i class="fa fa-edit "></i> Изменить</button> </a>
												  <a href="requests.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Вы уверены, что хотите удалить?')">
												<button class="btn btn-danger">Удалить</button>
											</a>
                                            </td>
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
