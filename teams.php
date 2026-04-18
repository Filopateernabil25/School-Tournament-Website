<?php include "./includes/header.php" ?>

<h1 class="bg-primary text-white p-3 rounded">Team Managment</h1>

<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $class_name=$_POST['class_name'];
    echo $class_name;
    $stmt=$pdo->prepare("INSERT INTO `teams`(`class_name`) VALUES (?)");
    $stmt->execute([$class_name]);
    header("location:teams.php");
}
?>
<form action="" method="post">

    <div class="row">
        <div class="col-md-6">
            <input type="text" name="class_name" class="form-control">
        </div>
        <div class="col-md-2">
            <button class="btn btn-success">Add Team</button>
        </div>
    </div>
</form>

<table class="table table-dark table-striped my-3">
    <tr>
        <th>Team Name</th>
        <th>Points</th>
        <th>Goals For</th>
        <th>Goals Against</th>
        <th>Action</th>
    </tr>
    <tbody>
        <?php
        $teams=$pdo->query("SELECT * FROM `teams`");
        foreach($teams as $team) : ?> 
        <tr>
            <td><?= $team['class_name'] ?></td>
            <td><?= $team['points'] ?></td>
            <td><?= $team['goals_scored'] ?></td>
            <td><?= $team['goals_aginest'] ?></td>
            <td>
                <a href="Edit" class="btn btn-warning">Edit</a>
                <a href="Edit" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include "./includes/footer.php" ?>