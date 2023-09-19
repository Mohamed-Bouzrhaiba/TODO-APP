<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    <?php
    if(!isset($_POST['id'])){
        header("location:index.php");
    }
        require_once 'includes/nav.php';
        require_once 'includes/db.php';
        $id = $_POST['id'];
        $stmt= $conn->prepare('SELECT * FROM tasks WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
           /* echo "<pre>";
            var_dump($row);
            echo "</pre>";
            echo $row['description'];
            echo $row['id'];*/

            if (isset($_POST['title'])) {
                $id = $_POST['id'];
                $description = $_POST['title'];
            
                if (!empty($id) && !empty($description)) {
                    try {
                        require_once 'includes/db.php';
                        $stmt = $conn->prepare("UPDATE `tasks` SET `description` = ? WHERE `id` = ?");
                        $stmt->execute([$description,$id]);


                        header("location: index.php");
                        
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                }
            }
            



        
    ?>
    <div class="container">
    <form method="post">
    <div class="form-group">
        <label class="font-weight-bold" for="exampleFormControlTextarea1">EDIT YOUR TASK:</label>        <textarea class="form-control" name="title" id="exampleFormControlTextarea1" rows="3"><?=$row['description'];?></textarea>

        <input type="hidden" name="id" value="<?=$row['id'];?>"> <!-- Add a hidden input for the 'id' -->
    </div>
    <div class="con-auto">
        <input class="btn btn-primary" type="submit" name="modify" value="MODIFY">
    </div>
</form>

    </div>
</body>
</html>