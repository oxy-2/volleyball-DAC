<?php
include 'db.php';

// Fetch all match data from DB
$sql = "SELECT * FROM torneio_results ORDER BY match_number ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Torneio de Voleibol</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        // Expand/collapse logic
        function toggleDetails(matchNumber) {
            const details = document.getElementById(`details-${matchNumber}`);
            details.classList.toggle('expanded');
        }
    </script>
</head>
<body>

<header>
    <h1>Torneio de Voleibol</h1>
</header>

<main>

    <h2>Resultados:</h2>

    <div class="results">
        <ul>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $matchNumber = $row['match_number'];
                    $score1 = $row['score_team1'];
                    $score2 = $row['score_team2'];

                    $winnerColor = $score1 > $score2 ? 'green' : 'red';
                    $loserColor = $score1 < $score2 ? 'green' : 'red';
                    $winnerText = $score1 > $score2 ? "{$row['team1']} venceu!" : "{$row['team2']} venceu!";
                    ?>

                    <li onclick="toggleDetails(<?= $matchNumber ?>)">
                        <div class="match-header">
                            <div class="match-number">Jogo <?= $matchNumber ?></div>
                            <div class="teams">
                                <span class="team"><?= $row['team1'] ?></span>
                                <span class="score">
                                    <span style="color: <?= $winnerColor ?>"><?= $score1 ?></span>
                                    <span class="score-separator">-</span>
                                    <span style="color: <?= $loserColor ?>"><?= $score2 ?></span>
                                </span>
                                <span class="team"><?= $row['team2'] ?></span>
                            </div>
                            <div class="faults">Faltas: <?= $row['faults_team1'] ?> | <?= $row['faults_team2'] ?></div>
                        </div>

                        <div class="match-details" id="details-<?= $matchNumber ?>">
                            <div class="result-status"><?= $winnerText ?></div>
                            <div class="player-lists">
                                <div class="team-players">
                                    <h4>Jogadores <?= $row['team1'] ?></h4>
                                    <?= nl2br($row['players_team1'] ?? 'N/A') ?>
                                </div>
                                <div class="team-players">
                                    <h4>Jogadores <?= $row['team2'] ?></h4>
                                    <?= nl2br($row['players_team2'] ?? 'N/A') ?>
                                </div>
                                <div class="bench-players">
                                    <h4>Não convocados</h4>
                                    <?= nl2br($row['bench_players'] ?? 'N/A') ?>
                                </div>
                            </div>
                        </div>
                    </li>

                    <?php
                }
            } else {
                echo "<li>Nenhum resultado encontrado.</li>";
            }
            ?>
        </ul>
    </div>

</main>

<footer>
    Feito por Miguel & Hugo<br>
    EBS Calheta, 10º4, nº19 e nº9, Curso de Programação
</footer>

<?php $conn->close(); ?>

</body>
</html>
