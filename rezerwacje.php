<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>KINO „Za rogiem”</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <img src="baner.jpg" alt="baner">
        </header>
        <main class="lewy">
            <ul>
                <li><a href="index.php">Strona główna</a></li>
            </ul>
            <hr>
            <form action="rezerwacje.php" method="post">
                <label for="data">data i</label> <label for="czas">godzina seansu</label><br>
                <input type="date" id="data" name="data">
                <input type="time" id="czas" name="czas">
                <button type="submit">Pokaż</button>
            </form>
        </main>
        <main class="prawy">
            <?php
            if (isset($_POST['data']) && isset($_POST['czas'])) {
                $data = $_POST['data'];
                $czas = $_POST['czas'];
                $zapytanie='SELECT Rzad, Miejsce FROM rezerwacje WHERE Data = "'.$data.'" AND Godzina = "'.$czas.'";';
                $polonczenie=mysqli_connect("localhost","root","","kino");
                $wynik=mysqli_query($polonczenie,$zapytanie);
                echo "<p>EKRAN</p>";
                echo "<table>";
                $wiersz=mysqli_fetch_assoc($wynik);
                for ($i = 1; $i <= 15; $i++) {
                    echo '<tr><td class="numer">'.$i.'</td>';
                    for ($j = 1; $j <= 20; $j++) {
                        if($i==$wiersz["Rzad"] && $j==$wiersz["Miejsce"])
                        {
                            echo'<td class="zajente">'.$j;
                            $wiersz=mysqli_fetch_assoc($wynik);
                        }
                        else{
                            echo'<td class="wolne">'.$j;
                        }
                        echo"</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
                mysqli_close($polonczenie);
            }
            
            ?>
        </main>
        <footer>
            <h5>Egzamin INF.03 - AUTOR: Paweł Małecki</h5>
        </footer>
    </body>
</html>
