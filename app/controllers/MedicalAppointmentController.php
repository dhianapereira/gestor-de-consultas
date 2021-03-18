<?php

use Mpdf\Mpdf;

require_once "src/services/MedicalAppointmentService.php";
require_once  "./vendor/autoload.php";

class MedicalAppointmentController
{
    public static function makeAnAppointment()
    {

        $patient_cpf = $_POST["patient_cpf"];
        $specialty = $_POST["specialty"];
        $genre = $_POST["genre"];
        $date = $_POST["date"];
        $time = $_POST["time"];
        $room = $_POST["room"];

        if (
            !isset($specialty) || !isset($patient_cpf) || !isset($genre)
            || !isset($date) || !isset($time) || !isset($room)
        ) {
            $_SESSION['errorMessage'] = "Você precisa preencher todos os campos para realizar esta operação!";
            require_once "app/pages/medical_appointment/register/index.php";
        } else {

            $result = MedicalAppointmentService::makeAnAppointment(
                $patient_cpf,
                $genre,
                $specialty,
                $date,
                $time,
                $room
            );

            if (!is_bool($result)) {
                $_SESSION['errorMessage'] = $result;
                require_once "app/pages/medical_appointment/register/index.php";
            } else {
                $_SESSION['successMessage'] = "A consulta foi marcada com sucesso!";
                require_once "app/pages/medical_appointment/register/index.php";
            }
        }
    }

    public static function allMedicalAppointments($start, $total_records)
    {
        $result = MedicalAppointmentService::allMedicalAppointments($start, $total_records);

        return $result;
    }

    public static function fetchMedicalAppointment()
    {
        $id = $_POST["id"];

        if (isset($id)) {
            $medical_appointment = MedicalAppointmentService::fetchMedicalAppointment($id);
            if ($medical_appointment == null || !is_object($medical_appointment)) {
                $_SESSION['errorMessage'] =  "Não há nenhuma consulta com o ID: $id";
                require_once "app/pages/medical_appointment/search/index.php";
            } else {
                require_once "app/pages/medical_appointment/update/index.php";
            }
        } else {
            $_SESSION['errorMessage'] =  "Você precisa inserir o ID da consulta!";
            require_once "app/pages/medical_appointment/search/index.php";
        }
    }

    public static function update()
    {
        $id = $_POST["id"];
        $specialty = $_POST["specialty"];
        $genre = $_POST["genre"];
        $room = $_POST["room"];
        $patient_cpf = $_POST["patient_cpf"];
        $date = $_POST["date"];
        $time = $_POST["time"];
        $arrival_time = $_POST["arrival_time"];
        $status = $_POST["status"];

        if (
            isset($id) && isset($specialty) && isset($genre)
            && isset($patient_cpf) && isset($status) && isset($date)
            && isset($time) && isset($arrival_time)
        ) {

            $medical_appointment = new MedicalAppointment(
                $id,
                $patient_cpf,
                [$specialty, $genre],
                $room,
                $date,
                $time,
                $arrival_time,
                $status
            );

            $result = MedicalAppointmentService::update($medical_appointment);

            if ($result == null || !is_bool($result)) {
                $_SESSION['errorMessage'] =  $result;
                require_once "app/pages/medical_appointment/update/index.php";
            } else {
                $_SESSION['successMessage'] =  "As atualizações foram realizadas com sucesso!";
                require_once "app/pages/medical_appointment/update/index.php";
            }
        } else {
            $_SESSION['errorMessage'] =  "Você precisa alterar alguma informação da consulta para que a operação seja realizada.";
            require_once "app/pages/medical_appointment/update/index.php";
        }
    }

    public static function listOfReportsByMonth()
    {
        if (isset($_POST["months"])) {

            $month = explode(' ', $_POST["months"]);

            $total_days = intval($month[0]);

            $month_in_number = strlen($month[1]) < 2 ? "0$month[1]" : $month[1];

            $month_name = $month[2];

            $result = MedicalAppointmentService::listOfReportsByMonth($total_days, $month_in_number);

            if ($result != null && !is_string($result)) {
                $mpdf = new Mpdf(['tempDir' => '../../../temp']);

                $html = "<div>    
                    <h2>Relatório de Atendimento no Mês de $month_name</h2>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Paciente</th>
                            <th>Médico(a)</th>
                            <th>Sala</th>
                            <th>Data e Horário</th>
                            <th>Horário de chegada</th>
                            <th>Consulta Realizada?</th>
                        </tr>";
                foreach ($result as $medical_appointment) {

                    $html .= "<tr>
                            <td>" . $medical_appointment->getId() . "</td>
                            <td>" . $medical_appointment->getPatientCpf() . "</td>
                            <td>" . $medical_appointment->getIdDoctor() . "</td>
                            <td>" . "id: " . $medical_appointment->getIdRoom()[0] . " " . $medical_appointment->getIdRoom()[1] . "</td>
                            <td>" . $medical_appointment->getDate() . " às " . $medical_appointment->getTime() . "</td>
                            <td>" . $medical_appointment->getArrivalTime() . "</td>
                            <td>" . $medical_appointment->getStatus() . "</td>
                        </tr>";
                }
                $html .= "
                    </table>
                </div>";

                $filename = "relatorio-de-consultas(" . $month_name . ")" . ".pdf";

                $stylesheet = file_get_contents('./public/styles/css/table.css');

                $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
                $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

                $mpdf->Output($filename, "D");

                require_once "app/pages/medical_appointment/reports/index.php";
            } else {
                $_SESSION['errorMessage'] = "Não há nenhuma consulta marcada no mês de $month_name.";
                require_once "app/pages/medical_appointment/reports/index.php";
            }
        } else {
            $_SESSION['errorMessage'] = "Você precisa escolher um mês para visualizar os prontuários .";
            require_once "app/pages/medical_appointment/reports/index.php";
        }
    }
}
