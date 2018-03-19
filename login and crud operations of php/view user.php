<?php
require_once "functions.php";
require_once "pagination.php";
check_session();
?>
<!DOCTYPE html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/lumen/bootstrap.min.css">
<link rel = "stylesheet" type = "text/css" href="view user.css"/>

<?php 
	nav_menu(); 
?>
<div class="container" style="margin-top:20px;">
<div class="row">
<div id="user" class="col-md-12" >
  <div class="panel panel-primary panel-table animated slideInDown">
   <div class="panel-heading " style="padding:5px;">
        <div class="row">
        <div class="col col-xs-3 text-left">
        </div>
        <div class="col col-xs-5 text-center">
        </div>
        <div class="col col-xs-2 text-right ">
          <a href="registeration.php" button type="button" class="btn  btn-success "> ADD NEW<i class="fa fa-plus-square" ></i></a></button>
        </div>
        </div>
    </div>
   <div class="panel-body">
    <div class="pagination">
	<div class="search">
	<form method="get" action="search.php">
	<input type="text" name="query"/>
	<?php
	 $flag = isset($_POST['flag']) ? $_POST['flag'] : '';
	?>
	<input type="submit" name="submit" value="Search"/>
	</form>
	</div>
    <?php  echo $paginationCtrls; ?></div> 
     <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="list">
       <table class="table table-striped table-bordered table-list">
        <thead>
         <tr>
            <th class="avatar">ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Contact</th>
			<th colspan="2">Action</th>
		  </tr> 
		  <tr>
  </thead>
  <body>
<?php
			while($row = mysqli_fetch_array($nquery)){
	
			  echo "<tr>";
		      echo "<td>" . $row['id'] . "</td>";
			  echo "<td>" . $row['first_name'] . "</td>";
              echo "<td>" . $row['last_name'] . "</td>";
              echo "<td>" . $row['contact_no'] . "</td>";
			  echo'<td><a href="edit.php?id='.$row['id'].'">Edit</a></td>';
              echo'<td><a href="delete.php?id='.$row['id'].'">Delete</a></td>';
              echo "</tr>";	
?>
			<?php
			}		
		    ?>

</body>
</html>
