<?php

include 'db.php';

$sql = "SELECT * FROM torneio_results ORDER BY match_number ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="veiwport" content="width=device-width, initial-scale=1.0">
        <title>Torneio de Voleibol</title>
        <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <h1>
            Torneio de Voleibol
        </h1>
    </header>

    <main>

        <h2>
            Resultados:
        </h2>


        <div class="results">
            <ul>
                <?php
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                    
                    echo "<li>";
                    
                    echo "<span class='match-number'>Jogo {$row['match_number']}:</span>";
                    echo "<span class='team team1'>{$row['team1']}</span>";
                    echo "<span class='score'>{$row['score_team1']} - {$row['score_team2']}</span>";
                    echo "<span class='team team2'>{$row['team2']}</span>";
                    echo "<span class='faults'>Faltas: {$row['faults_team1']} | {$row['faults_team2']}</span>";
                    echo "</li>";
                    }
                } else {
                    echo "<li>No results found.</li>";
                }

                ?>
            </ul>
        </div>


    </main>

    <footer>
        Feito por Miguel & Hugo
        EBS Calheta, 10º4, nº19 e nº9, Curso de Programmação
    </footer>

<?php $conn->close(); ?>

</body>
</html>