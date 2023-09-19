
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php include_once'includes/nav.php';?>

        <div class="container">
        <?php
        if(isset($_POST['title'])){

            $description = $_POST['title'];    
            if(!empty($description)){
            require("includes/db.php");
            $stmt = $conn->prepare("INSERT INTO tasks VALUES (NULL,?)");
            $result = $stmt->execute([$description]);?>
            <div class="alert alert-success" role="alert">
                 ADDED  SUCCEFULLY..!
             </div><?php header("location:index.php");
            }
            else{
                ?>
                <div class="alert alert-danger" role="alert">
                 DESCRIPTION IS REQUIRED..!
                </div>
                <?php
            }
        }
        ?>
        <form method="post">
        <div class="form-group">
        <label class="font-weight-bold" for ="exampleFormControlTextarea1">ADD YOUR TASK :</label>
        <textarea class="form-control" name = "title" rows="3"></textarea>
        </div>
        <div class="con-auto">
        <input class="btn btn-primary" type="submit" value="ADD">
        </div>
        </form>
    </div>

    <div class="container">
        <?php 
        require("includes/db.php");
        $stmt = $conn->query("SELECT * FROM `tasks`");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        /*echo "<pre>";
        print_r($data);
        echo "</pre>";
        var_dump($conn);*/
        ?>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">DESCRIPTION</th>
      <th scope="col">ACTION</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($data as $onerow){?>
    <tr>
      <th>  <span class="badge rounded-pill bg-light text-dark"><?=$onerow['id'] ?></span>

    </th>
      <td><?=$onerow['description'] ?></td>
      <td>
        <form  method="post">
        <input type="hidden" name= "id" value="<?=$onerow['id']?>" >
        <input formaction="update.php" class="btn btn-warning" type="submit" value="Update" name="EDIT"  >
        <input formaction="delete.php" class="btn btn-danger" type="submit" value="Delete" name = "ddelete"
         onclick="return confirm('Are you sure you want to delete :  <?php echo $onerow['description'] ?> ???');">
        </form>
      </td>

    </tr>
    <?php 
    }?>
  </tbody>
</table>
    </div>
</body>
</html>