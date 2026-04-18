<?php include "./includes/header.php" ?>

<h1 class="bg-primary text-white p-3 rounded">Tournament Standings</h1>

<table class="table table-dark table-striped">
    <tr>
        <th>#</th>
        <th>Team</th>
        <th>P</th>
        <th>W</th>
        <th>D</th>
        <th>L</th>
        <th>GF</th>
        <th>GA</th>
        <th>GD</th>
        <th>Pts</th>
    </tr>
    <tbody>
        <?php
        $teams = $pdo->query("SELECT teams.id, teams.class_name,COUNT(matches.id) AS matches_played,teams.goals_scored, teams.goals_aginest, teams.points, (teams.goals_scored-teams.goals_aginest) AS goal_Difference,
        SUM( 
        (teams.id = matches.team1_id AND matches.team1_goals > matches.team2_goals) 
        OR (teams.id = matches.team2_id AND matches.team2_goals > matches.team1_goals) 
        ) AS wins,
        SUM( 
        (teams.id = matches.team1_id AND matches.team1_goals = 
        matches.team2_goals) 
        OR (teams.id = matches.team2_id AND matches.team1_goals = 
        matches.team2_goals) 
        ) AS draws,
        SUM( 
        (teams.id = matches.team1_id AND matches.team1_goals < 
        matches.team2_goals) 
        OR (teams.id = matches.team2_id AND matches.team2_goals < 
        matches.team1_goals) 
        ) AS losses
        FROM teams LEFT JOIN matches ON teams.id = matches.team1_id OR teams.id = matches.team2_id GROUP BY teams.class_name");

        foreach ($teams as $team) : ?>
            <tr>
                <td><?= $team['id'] ?></td>
                <td><?= $team['class_name'] ?></td>
                <td><?= $team['matches_played'] ?></td>
                <td><?= $team['wins'] ?></td>
                <td><?= $team['draws'] ?></td>
                <td><?= $team['losses'] ?></td>
                <td><?= $team['goals_scored'] ?></td>
                <td><?= $team['goals_aginest'] ?></td>
                <td><?= $team['goal_Difference'] ?></td>
                <td><?= $team['points'] ?></td>
            </tr>

        <?php endforeach;?>
    </tbody>
</table>

<?php include "./includes/footer.php" ?>