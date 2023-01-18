<?php

class Autos extends Controller
{

    private $AutoModel;

    public function __construct()
    {
        //we maken een object van de model class en stoppen dit in $lesModel
        $this->AutoModel = $this->model('Les');
    }


    public function index()
    {

        $result = $this->AutoModel->getLessen();

        $rows = "";
        foreach ($result as $Autoinfo) {
            $dateTimeObj =
                new DateTimeImmutable(
                    $Autoinfo->DatumTijd,
                    new DateTimeZone('Europe/Amsterdam')
                );
            $rows .= "<tr>
                     <td>{$dateTimeObj->format('d-m-Y')}</td>
                     <td>{$dateTimeObj->format('H:i')}</td>
                     <td>{$Autoinfo->LENA}</td>
                     <td></td>
                     <td>
                         <a href='" . URLROOT . "/Autos/topicAutos/{$Autoinfo->LEID}'> 
                             <img src='" . URLROOT . "/img/b_sbrowse.png' alt='table picture'>
                         </a>             
                      </td> 
                     </tr>";
        }


        $data = [
            'title' => 'Overzicht Autos',
            'rows' => $rows,
            'instructorName' => $result[0]->INNA
        ];
        $this->view('Autos/index', $data);
    }

    public function topicAutos($id = NULL)
    {
        $result = $this->AutoModel->getTopics($id);
        var_dump($result);

        if ($result) {

            $dt = new DateTimeImmutable($result[0]->DatumTijd, new DateTimeZone('Europe/Amsterdam'));
            $date = $dt->format('d-m-Y');
            $time = $dt->format('H:i');
            //var_dump($dt);
            $Id = $result[0]->Id;
        } else {
            $date = "";
            $time = "";
            $Id = "";
        }
        

        $rows = "";

        foreach ($result as $topic) {

            $rows .= "<tr>
                     <td>{$topic->Onderwerp}</td>
                     </tr>";
        }

        $data = [
            'title' => 'Onderwerpen Auto',
            'rows' => $rows,
            'date' => $date,
            'time' => $time,
            'AutosId' => $Id

        ];
        $this->view('Autos/topicAutos', $data);
    }

    public function addTopic($id = NULL)
    {
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $this->AutoModel->addTopic($_POST);

          if ($result) {
                    $data['title'] = "<p>Het nieuwe onderwerp is succesvol toegevoegd</p>";
                } else {
                    echo "<p>Het nieuwe onderwerp is niet toegevoegd</p>";
                }
                header('Refresh:2 url=' . URLROOT . '/Autos/index');
            } else {
                header('Refresh:2 url=' . URLROOT . '/Autos/addTopic/' . $data['AutoId']);
            }
        }
    }
