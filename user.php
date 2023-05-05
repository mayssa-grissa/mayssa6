
<?php

    include 'connect.php';
    session_start();

    $user_id = $_SESSION['user_id'];
    
    if(!$user_id){
        header("Location: register.php");
    }


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digifarm Dashboard user</title>

    <!-- file cdnjs css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style\user.css">
</head>
<body>

    <main>
        <section class="left">
            <div class="box">
                <h3> Digifarm </h3>
                <p>Planification des cultures</p>
                <a href="logout.php">Logout</a>
            </div>
        </section>

        <header class="header">
            <div class="flex">
                <?php

                    $select_name = $conn->prepare("SELECT * FROM admin_page WHERE id = ?");
                    $select_name->execute([$user_id]);
                    $fetch_name = $select_name->fetch(PDO::FETCH_ASSOC);
                ?>
                <h2>Username: <span><?= $fetch_name['name']?></span></h2>
                <img src="images/user.png" alt="">
            </div>

           <div class="div">


           <form action="" method="post">
            <h1>Solution</h1>
        <select name="texture_de_sol" id="texture_de_sol"><br>
            <option value="" hidden>choisir la Texture_de_sol</option>
            <option value="humifiere">humifiere</option>
            <option value="leger">leger</option>
            <option value="argileux">argileux</option>
            <option value="limoneux">limoneux</option>
            <option value="argilo_calcaire">argilo calcaire</option>
            <option value="silico_argileux">silico argileux</option>
            <option value="sableux_argileux">sableux argileux</option>
            <option value="sableux_limoneux">sableux limoneux</option>
            <option value="limoneux_sableux">limoneux sableux</option>
            <option value="argileux_sableux">argileux sableux</option>
        </select>
        <select name="salinite_de_sol" id="salinite_de_sol"><br>
            <option value="" hidden>choisir la Salinite de_sol</option>
            <option value="[0;4[">entre 0 et 4</option>
            <option value="[4;8[">supérieur à 4[</option>

        </select>
        <select name="ph" id="ph"><br>
            <option value="" hidden>choisir le ph</option>
            <option value="inferieur_à_6,5">inferieur à 6,5</option>
            <option value="[6,5;7,5]">entre 6,5 et 7,5</option>
            <option value="superieur_à_7,5">superieur à 7,5</option>

        </select>
        <select name="salinite_d_eau" id="salinite_d_eau"><br>
            <option value="" hidden>choisir la Salinite d'eau</option>
            <option value="[0;0,5[">[0;0,5[</option>
            <option value="[0,5;1[">[0,5;1[</option>
            <option value="[1;1,5[">[1;1,5[</option>
            <option value="[1,5;2[">[1,5;2[</option>
            <option value="[2;2,5[">[2;2,5[</option>
            <option value="[2,5;3[">[2,5;3[</option>
            <option value="[3;4[">[3;4[</option>
        </select>
        <select name="saison" id="saison"><br>
            <option value="" hidden>choisir la saison Saison</option>
            <option value="printemps">printemps</option>
            <option value="hiver">hiver</option>
            <option value="automne">automne</option>
            <option value="ete">ete</option>
        </select>
        <select name="culture_precedente" id="culture_precedente"><br>
            <option value="" hidden>choisir la Culture précédente</option>
            <option value="courgette">courgette</option>
            <option value="laitue">laitue</option>
            <option value="feve">feve</option>
            <option value="pomme de terre">pomme de terre</option>
            <option value="haricot">haricot</option>
            <option value="carotte">carotte</option>
            <option value="persil">persil</option>
            <option value="pois">pois</option>
            <option value="ognion">ognion</option>
            <option value="aubergine">aubergine</option>
            <option value="blette">blette</option>
            <option value="asperge">asperge</option>
            <option value="artichaut">artichaut</option>
            <option value="tomate">tomate</option>
            <option value="ail">ail</option>

        </select>
        <select name="matiere_organique" id="matiere_organique">
            <option value="" hidden>choisir la Matiereorganique</option>
            <option value="superieur_à_2%">superieur à 2%</option>
            <option value="inferieur_à_2%">inferieur_à_2%</option>
        </select>
        <select name="calcaire_totale" id="calcaire_totale"><br>
            <option value="" hidden>Select Calcaire_totale</option>
            <option value="superieur_à_12%">superieur à 12%</option>
            <option value="inferieur_à_4%">inferieur à 4%</option>
            <option value="[4;12]">entre 4 et 12</option>
        </select>

        <button type="submit" name="submit">Submit</button>

    </form>


  
           </div>
        </header>
    </main>

  
</body>

</html>