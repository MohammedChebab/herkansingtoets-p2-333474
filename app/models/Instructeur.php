<?php

/**
 * Dit is de model voor de controller Countries
 */

class Instructeur
{
    //properties
    private $db;

    // Dit is de constructor van de Auto model class
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getInstructeurs()
    {
        $this->db->query('SELECT * FROM Instructeur');
        return $this->db->resultSet();
    }

    public function getInstructeur($id)
    {
        $this->db->query("SELECT * FROM Instructeur WHERE Id = :id");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function createInstructeur($post)
    {
        $this->db->query("INSERT INTO Instructeur (Id, 
                                               Voornaam, 
                                               Tussenvoegsel, 
                                               Achternaam,, 
                                               Mobiel,
                                               Datum_in_dienst)
                          VALUES              (:Id,
                                               :Voornaam, 
                                               :Tussenvoegsel, 
                                               :Achternaam,, 
                                               :Mobiel,
                                               :Datum_in_dienst)");
        $this->db->bind(':Id', NULL, PDO::PARAM_NULL);
        $this->db->bind(':Voornaam', $post['voornaam'], PDO::PARAM_STR);
        $this->db->bind(':Tussenvoegsel', $post['tussenvoegsel'], PDO::PARAM_STR);
        $this->db->bind(':Achternaam', $post['achternaam'], PDO::PARAM_STR);
        $this->db->bind(':Mobiel', $post['mobiel'], PDO::PARAM_INT);
        $this->db->bind(':Datum_in_dienst', $post['datum_in_dienst'], PDO::PARAM_STR);
        return $this->db->execute();

    }


}