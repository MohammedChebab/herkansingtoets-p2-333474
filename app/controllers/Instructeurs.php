<?php

class Instructeurs extends Controller
{
    //properties
    private $InstructeurModel;

    // Dit is de constructor van de controller
    public function __construct($Voornaam = 'Li', $Achternaam = 'Jiang') 
    {
        $this->InstructeurModel = $this->model('Instructeur');
    }

    public function index()
    {
        $records = $this->InstructeurModel->getInstructeurs();
        //var_dump($records);

        $rows = '';

        foreach ($records as $items)
        {
            $rows .= "<tr>
                        <td>$items->Id</td>
                        <td>$items->Voornaam</td>
                        <td>$items->Tussenvoegsel</td>
                        <td>$items->Achternaam</td>
                        <td>$items->Mobiel</td>
                        <td>$items->Datum_in_dienst</td>
                      </tr>";
        }

        $data = [
            'title' => "Alle instructeurs zonder auto",
            'rows' => $rows
        ];
        $this->view('Instructeurs/index', $data);
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // $_POST array schoonmaken
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $result = $this->InstructeurModel->createInstructeur($_POST);

            if ($result) {
                echo "Het invoeren is gelukt";
                header("Refresh:3; URL=" . URLROOT . "/Instructeurs/index");
            } else {
                echo "Het invoeren is NIET gelukt";
                header("Refresh:3; URL=" . URLROOT . "/Instructeurs/index");
            }
        }

        $data = [
            'title' => 'Voeg een nieuw auto toe'
        ];
        $this->view('Instructeurs/create', $data);
    }
}