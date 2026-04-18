<?php include "./includes/header.php" ?>

<h1 class="bg-primary text-white p-3 rounded">Match Management</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $team1_id = $_POST["team1_id"];
    $team2_id = $_POST["team2_id"];
    $team1_goal = $_POST["team1_goal"];
    $team2_goal = $_POST["team2_goal"];
    $date = $_POST["date"];
    $stmt = $pdo->prepare("INSERT INTO `matches`(`team1_id`, `team2_id`, `team1_goals`, `team2_goals`, `match_date`) VALUES (?,?,?,?,?)");
    $stmt->execute([$team1_id, $team2_id, $team1_goal, $team2_goal, $date]);
    header("location:matches.php");
    $pointsForTeam1 = 0;
    $pointsForTeam2 = 0;
    if ($team1_id) {
        if ($team1_goal > $team2_goal) {
            $pointsForTeam1 = 3;
        } elseif ($team1_goal == $team2_goal) {
            $pointsForTeam1 = 1;
        }
        $stmt = $pdo->prepare("UPDATE `teams` SET `points`=points+?,`goals_scored`=goals_scored+?,`goals_aginest`=goals_aginest + ? WHERE id=?");
        $stmt->execute([$pointsForTeam1, $team1_goal, $team2_goal, $team1_id]);
    }
    if ($team2_id) {
        if ($team2_goal > $team1_goal) {
            $pointsForTeam2 = 3;
        } elseif ($team1_goal == $team2_goal) {
            $pointsForTeam2 = 1;
        }
        $stmt = $pdo->prepare("UPDATE `teams` SET `points`=points+?,`goals_scored`=goals_scored+?,`goals_aginest`=goals_aginest + ? WHERE id=?");
        $stmt->execute([$pointsForTeam2, $team2_goal, $team1_goal, $team2_id]);
    }
}
?>

<form action="" class="mb-3" method="post">
    <div class="row">
        <div class="col-md-3">
            <select name="team1_id" class="form-select" id="">
                <?php
                $teams = $pdo->query("SELECT * FROM `teams`");
                foreach ($teams as $team) { ?>
                    <option value="<?= $team['id'] ?>"><?= $team['class_name'] ?></option>
                <?php }
                ?>
            </select>
        </div>
        <div class="col-md-1">
            <input type="number" name="team1_goal" class="form-control">
        </div>
        <div class="col-md-1">
            <input type="number" name="team2_goal" class="form-control">
        </div>
        <div class="col-md-3">
            <select name="team2_id" class="form-select" id="">
                <?php
                $teams = $pdo->query("SELECT * FROM `teams`");
                foreach ($teams as $team) { ?>
                    <option value="<?= $team['id'] ?>"><?= $team['class_name'] ?></option>
                <?php }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <input type="date" name="date" class="form-control">
        </div>
        <div class="col-md-1">
            <button class="btn btn-success">Save</button>
        </div>
    </div>
</form>
<table class="table table-dark table-striped">
    <tr>
        <th>Date</th>
        <th>Match</th>
        <th>Result</th>
    </tr>
    <tbody>
        <?php
        $matches = $pdo->query("SELECT team1.class_name AS team1name,team2.class_name AS team2_name,matches.match_date,matches.team1_goals,matches.team2_goals FROM matches
LEFT JOIN teams AS team1 ON matches.team1_id=team1.id
LEFT JOIN teams AS team2 ON matches.team2_id=team2.id");
        foreach ($matches as $team) : ?>
            <tr>
                <td><?= $team['match_date'] ?></td>
                <td><?= $team['team1name'] ?> VS <?= $team['team2_name'] ?></td>
                <td><?= $team['team1_goals'] ?> - <?= $team['team2_goals'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php include "./includes/footer.php" ?>