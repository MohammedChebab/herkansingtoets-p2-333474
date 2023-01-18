<?php

/**
 * Dit is de model voor de controller lessen
 */

class Auto
{
    //properties
    private $db;

    // Dit is de constructor van de Country model class
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAutos()
    {
        $this->db->query("SELECT Auto.DatumTijd
                                ,Auto.Id as LEID
                                ,Instructeur.Naam as INNA
                            FROM Auto
                            INNER JOIN Instructeur
                            ON Instructeur.Id = Auto.InstructeurId
                            WHERE Auto.InstructeurId = :Id");

        $this->db->bind(':Id', 2, PDO::PARAM_INT);

        return $this->db->resultSet();
    }

    public  function getTopics($AutoId)
    {
        $sql = "SELECT Auto.DatumTijd
                      ,Auto.Id
                      ,Onderwerp.Onderwerp
        FROM onderwerp
        INNER JOIN Auto
        ON Auto.Id = Onderwerp.AutoId
        WHERE AutoId = :AutosId";

        $this->db->query($sql);

        $this->db->bind(':AutoId', $AutoId, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function addTopic($post)
    {
        $sql = "INSERT INTO Onderwerp Autoid 
                                       ,Onderwerp
                VALUES                (AutoId,
                                       :topic);";

      $this->db->query($sql);

      $this->db->bind(':AutoId', $post['id'], PDO::PARAM_INT);
      $this->db->bind(':topic', $post['id'], PDO::PARAM_STR);

      return $this->db->execute();

    }
}
