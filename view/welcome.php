<?php
require ROOT . "/view/head.php";
require ROOT . "/view/header.php";
require ROOT . "/view/menu.php";
?>
    <div class="sophro">
        <div class="picSophro">
            <img class="rb" src="./public/images/rb(1).jpeg" alt="R. Breton, la sophrologue, souriante">
        </div>
        <div class="sophro-content">
        <p>S comme sincère et ouverte dans ma présence empathique et ma capacité à vibrer en écho à ce que l'autre vit.<br>
        O comme optimiste. J'ai a coeur de voir le côté positif des défis que j'ai à relever.<br>
        P comme patiente, je prends le temps de comprendre une situation dans son ensemble.<br>
        H comme humaine et heureuse du choix de ma nouvelle orientation professionnelle.<br>
        R comme réceptive et rassurante pour accueillir l'humain et l'humaine dans sa richesse et sa différence sans jugement.<br>
        O comme ouverte à l'accueil et l'accompagnement de l'uatre dans sa diversité.<br>
        L comme libre. J'aime avoir une liberté d'action avec justesse et lucidité.<br>
        O comme originale, je sais apporter une note unique à ce que je propose.<br>
        G comme garante du cadre de l'accompagnement de que je vous propose de vivre et d'expérimenter.<br>
        U comme utile dans l'accompagnement de votre chemin de vie.<br>
        E comme enthousiaste et éclairante pour vous accompagner au plus près de vos besoins.<br>
        </p>
        
        <form action="index.php" method="get" class= "formSophro">
            <input type="hidden" name="action" value="presentation">
            <input class="buttonSophro" type="submit" value="En savoir plus">
        </form>
        </div>
    </div>
<?php
require ROOT . "/view/service.php";
require ROOT . "/view/post.php";
require ROOT . "/view/testimony.php";
require ROOT . "/view/footer.php";
?>
</body>
</html>