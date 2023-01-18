<h3><?= $data['title']; ?></h3>

<form action="<?= URLROOT; ?>/Instructeurs/create" method="post">
    <table>
        <tbody>
            <tr>
                <td>Naam:</td>
                <td><input type="text" name="voornaam" id="voornaam"></td>
            </tr>
            <tr>
                <td>Tussenvoegsel:</td>
                <td><input type="text" name="tussenvoegsel" id="tussenvoegsel"></td>
            </tr>
            <tr>
                <td>Achternaam:</td>
                <td><input type="text" name="achternaam" id="aAchternaam"></td>
            </tr>
            <tr>
                <td>Mobiel:</td>
                <td><input type="text" name="mobiel" id="mobiel"></td>
            </tr>
            <tr>
                <td>Datum in dienst:</td>
                <td><input type="text" name="datum_in_dienst" id="datum_in_dienst"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" id="submit" value="Verstuur"></td>
            </tr>
        </tbody>
    </table>

</form>