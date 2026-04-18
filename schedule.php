<?php include "./includes/header.php";

$upcomingMatches = $pdo->query("
SELECT 
    matches.id, matches.team1_id, matches.team2_id, matches.team1_goals, matches.team2_goals, matches.match_date,
    team1.class_name AS team1_name, team2.class_name AS team2_name
FROM matches

LEFT JOIN teams AS team1 
    ON matches.team1_id = team1.id

LEFT JOIN teams AS team2 
    ON matches.team2_id = team2.id

WHERE matches.match_date > NOW()

ORDER BY matches.match_date ASC
")->fetchAll();


$pastMatches = $pdo->query("
SELECT matches.id, matches.team1_id, matches.team2_id, matches.team1_goals, matches.team2_goals, matches.match_date,
    team1.class_name AS team1_name,team2.class_name AS team2_name

FROM matches

LEFT JOIN teams AS team1 
    ON matches.team1_id = team1.id

LEFT JOIN teams AS team2 
    ON matches.team2_id = team2.id

WHERE matches.match_date <= NOW()

ORDER BY matches.match_date DESC
LIMIT 5
")->fetchAll();

?>

<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h2>Match Schedule</h2>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="scheduleTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="upcoming-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#upcoming" type="button" role="tab">
                    Upcoming Matches
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="past-tab" data-bs-toggle="tab"
                    data-bs-target="#past" type="button" role="tab">
                    Recent Results
                </button>
            </li>
        </ul>

        <div class="tab-content p-3 border border-top-0 rounded-bottom">
            <div class="tab-pane fade show active" id="upcoming"
                role="tabpanel">
                <?php if (count($upcomingMatches) > 0): ?>
                    <div class="list-group">
                        <?php foreach ($upcomingMatches as $match): ?>
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?= $match['team1_name'] ?> vs <?= $match['team2_name'] ?></h5>
                                    0 - 0
                                    <p class="mb-1">
                                        <span class="badge bg-info text-dark">
                                            <?= date($match['match_date']) ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">No upcoming matches
                        scheduled yet.</div>
                <?php endif; ?>
            </div>

            <div class="tab-pane fade" id="past" role="tabpanel">

                <?php if (count($pastMatches) > 0): ?>

                    <div class="list-group">
                        <?php foreach ($pastMatches as $match): ?>

                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">
                                        <?= $match['team1_name'] ?>
                                        <span class="badge bg-primary"><?= $match['team1_goals'] ?></span>
                                        -
                                        <span class="badge bg-primary"><?= $match['team2_goals'] ?></span>
                                        <?= $match['team2_name'] ?>
                                    </h5>

                                    <small class="badge bg-info text-dark mb-2">
                                        <?= date($match['match_date']) ?>
                                    </small>

                                </div>
                                <p class="mb-1">
                                    <?php
                                    $winner = ($match['team1_goals'] > $match['team2_goals']) ? $match['team1_name'] : (($match['team2_goals'] > $match['team1_goals']) ? $match['team2_name'] : null);
                                    ?>
                                    <?php if ($winner): ?>
                                        <span
                                            class="badge bg-success"><?= $winner ?> won</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Draw</span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">No match results available
                        yet.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>