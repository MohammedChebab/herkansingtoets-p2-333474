<?php

class Lessen extends Controller
{

    private $lesModel;

    public function __construct()
    {
        //we maken een object van de model class en stoppen dit in $lesModel
        $this->lesModel = $this->model('Les');
    }


    public function index()
    {

        $result = $this->lesModel->getLessen();

        $rows = "";
        foreach ($result as $lesinfo) {
            $dateTimeObj =
                new DateTimeImmutable(
                    $lesinfo->DatumTijd,
                    new DateTimeZone('Europe/Amsterdam')
                );
            $rows .= "<tr>
                     <td>{$dateTimeObj->format('d-m-Y')}</td>
                     <td>{$dateTimeObj->format('H:i')}</td>
                     <td>{$lesinfo->LENA}</td>
                     <td></td>
                     <td>
                         <a href='" . URLROOT . "/lessen/topiclesson/{$lesinfo->LEID}'> 
                             <img src='" . URLROOT . "/img/b_sbrowse.png' alt='table picture'>
                         </a>             
                      </td> 
                     </tr>";
        }


        $data = [
            'title' => 'Overzicht Lessen',
            'rows' => $rows,
            'instructorName' => $result[0]->INNA
        ];
        $this->view('lessen/index', $data);
    }

    public function topicLesson($id = NULL)
    {
        $result = $this->lesModel->getTopics($id);
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
            'title' => 'Onderwerpen Les',
            'rows' => $rows,
            'date' => $date,
            'time' => $time,
            'lessonId' => $Id

        ];
        $this->view('lessen/topiclessen', $data);
    }

    public function addTopic($id = NULL)
    {
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $this->lesModel->addTopic($_POST);

          if ($result) {
                    $data['title'] = "<p>Het nieuwe onderwerp is succesvol toegevoegd</p>";
                } else {
                    echo "<p>Het nieuwe onderwerp is niet toegevoegd</p>";
                }
                header('Refresh:2 url=' . URLROOT . '/lessen/index');
            } else {
                header('Refresh:2 url=' . URLROOT . '/lessen/addTopic/' . $data['lesId']);
            }
        }
    }
