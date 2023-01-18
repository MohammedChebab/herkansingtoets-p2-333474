<?php

/**
 * Dit is de model voor de controller lessen
 */

class Les
{
    //properties
    private $db;

    // Dit is de constructor van de Country model class
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getLessen()
    {
        $this->db->query("SELECT Les.DatumTijd
                                ,Les.Id as LEID
                                ,Leerling.Id
                                ,Leerling.Naam as LENA
                                ,Instructeur.Naam as INNA
                            FROM Les
                            INNER JOIN Leerling
                            ON Leerling.Id = Les.LeerlingId
                            INNER JOIN Instructeur
                            ON Instructeur.Id = Les.InstructeurId
                            WHERE Les.InstructeurId = :Id");

        $this->db->bind(':Id', 2, PDO::PARAM_INT);

        return $this->db->resultSet();
    }

    public  function getTopics($lessenId)
    {
        $sql = "SELECT Les.DatumTijd
                      ,Les.Id
                      ,Onderwerp.Onderwerp
        FROM onderwerp
        INNER JOIN Les
        ON Les.Id = Onderwerp.LesId
        WHERE LesId = :lessonId";

        $this->db->query($sql);

        $this->db->bind(':lessonId', $lessenId, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function addTopic($post)
    {
        $sql = "INSERT INTO Onderwerp (Lesid 
                                       ,Onderwerp
                VALUES                (LesId,
                                       :topic);";

      $this->db->query($sql);

      $this->db->bind(':lesId', $post['id'], PDO::PARAM_INT);
      $this->db->bind(':topic', $post['id'], PDO::PARAM_STR);

      return $this->db->execute();

    }
}
