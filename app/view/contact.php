
    <div id="contact">
        <h2>Contact</h2>
        <p>N’hésitez pas à me contacter au <strong>0601020304</strong> ou par l'intermédiaire de ce formulaire:</p>
        <form action="envoyermessage.php" method="post">
            <p>Civilité :
                <input type="radio" name="civilite" id="M"> <label for="M">M.</label>
                <input type="radio" name="civilite" id="Mme"> <label for="Mme">Mme</label>
                <input type="radio" name="civilite" id="Autre"> <label for="Autre">Autre</label>
            </p>  
            <p><label for="nom">Nom:</label><br><input type="text" name="nom" id="nom" placeholder="Tapez votre nom"></p>
            <p><label for="prenom">Prenom:</label><br><input type="text" name="prenom" id="prenom"></p>
            <p><label for="email">Email:</label><br><input type="email" name="email" id="email"></p>
            <p>
                <label for="message">Message:</label><br>
                <textarea name="message" id="message" rows="5" maxlength="200"></textarea>
            </p>
            <p>
                <input type="submit" value="Envoyer">
                <input type="reset" value="Annuler">
            </p>
        </form>
       
    
    </div>
</body>