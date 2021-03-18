<?php

use Mpdf\Mpdf;

require_once "src/services/MedicalRecordsService.php";
require_once  "./vendor/autoload.php";
class MedicalRecordsController
{

  public static function fetchMedicalRecords()
  {
    $cpf = $_POST["cpf"];

    if (isset($cpf)) {
      $medical_records = MedicalRecordsService::fetchMedicalRecords($cpf);

      if ($medical_records == null || !is_object($medical_records)) {
        $_SESSION['errorMessage'] = "Não há nenhum prontuário com o CPF: $cpf";
        require_once "app/pages/medical_records/search/index.php";
      } else {
        require_once "app/pages/medical_records/details/index.php";
      }
    } else {
      $_SESSION['errorMessage'] = "Você precisa inserir um CPF!";
      require_once "app/pages/medical_records/search/index.php";
    }
  }

  public static function download()
  {

    $mpdf = new Mpdf(['tempDir' => '../../../temp']);

    $cpf = $_POST["cpf"];
    $full_name = $_POST["full_name"];
    $date_of_birth = $_POST["date_of_birth"];
    $genre = $_POST["genre"];
    $naturalness = $_POST["naturalness"];
    $mother_name = $_POST["mother_name"];
    $companion = $_POST["companion"];
    $patient_address = $_POST["patient_address"];
    $start_date = $_POST["start_date"];
    $result = $_POST["result"];
    $gravity = $_POST["gravity"];
    $symptoms = $_POST["symptoms"];

    $html = "<div class='form'>
        <h2>Prontuário</h2>
        <form>
            <h2>Dados Pessoais</h2>
          <div class='input-block'>
            <label>Nome</label>
            <input value='$full_name' disabled />
          </div>
          <div class='input-block'>
            <label>CPF </label>
            <input value='$cpf' disabled />
          </div>
          <div class='input-block'>
            <label>Data de nascimento </label>
            <input value='$date_of_birth' disabled />
          </div>
          <div class='input-block'>
            <label>Gênero: </label>
            <input value='$genre' disabled />
          </div>
          <div class='input-block'>
            <label>Naturalidade: </label>
            <input value='$naturalness' disabled />
          </div>
          <div class='input-block'>
            <label>Nome da Mãe</label>
            <input value='$mother_name' disabled />
          </div>
          <div class='input-block'>
            <label>Acompanhante</label>
            <input value='$companion' disabled />
          </div>
          <div class='input-block'>
            <label>Endereço</label>
            <input value='$patient_address' disabled />
          </div>
          <h2>Resultados</h2>
          <div class='input-block'>
            <label>Data de início dos sintomas</label>
            <input value='$start_date' disabled />
          </div>
          <div class='input-block'>
            <label>Resultado (%) </label>
            <input value='$result' disabled />
          </div>
          <div class='input-block'>
            <label>Gravidade </label>
            <input value='$gravity' disabled />
          </div>
          <h2>Sintomas</h2>";
    if ($symptoms == null) {
      $html .= "<ul>
                        <li>Este paciente não possui nenhum sintoma de Dengue.</li>
                    </ul>";
    } else {
      foreach ($symptoms as $symptom) {
        $html .= "<ul>
                            <li>" . $symptom . "</li>
                        </ul>";
      }
    }
    $html .= " </form>
                </div>";


    $filename = "prontuario-do-paciente-$cpf" . ".pdf";

    $stylesheet = file_get_contents('./public/styles/css/form.css');

    $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

    $mpdf->Output($filename, "D");

    require_once "app/pages/medical_records/search/index.php";
  }

  public static function allMedicalRecords($start, $total_records)
  {
    $result = MedicalRecordsService::allMedicalRecords($start, $total_records);

    return $result;
  }

  public static function listOfSymptomsByMonth()
  {
    if (isset($_POST["months"])) {

      $month = explode(' ', $_POST["months"]);

      $total_days = intval($month[0]);

      $month_in_number = strlen($month[1]) < 2 ? "0$month[1]" : $month[1];

      $month_name = $month[2];

      $result = MedicalRecordsService::listOfSymptomsByMonth($total_days, $month_in_number);

      if ($result != null && !is_string($result)) {
        $_SESSION['successMessage'] = "O sintoma mais recorrente no mês de $month_name ($result[1]%) foi: $result[0]";
        require_once "app/pages/medical_records/most_recurrent_symptom/index.php";
      } else {
        $_SESSION['errorMessage'] = "Não há nenhum sintoma recorrente no mês de $month_name.";
        require_once "app/pages/medical_records/most_recurrent_symptom/index.php";
      }
    } else {
      $_SESSION['errorMessage'] = "Você precisa escolher um mês para visualizar o sintoma mais recorrente.";
      require_once "app/pages/medical_records/most_recurrent_symptom/index.php";
    }
  }
}
