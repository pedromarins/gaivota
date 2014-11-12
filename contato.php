<?php include("_header.php")?>

<?php

if(isset($_GET["email"])) {
 
     
 

    $email_to = "henriquedeandrade@gmail.com";
 
    $email_subject = "Contato Gaivota";
 
     
 
     
 
    function died($error) {
 

        echo "Me desculpe mas houve um erro no envio da mensagem.";
 
        echo "<br /><br />";
 
        echo $error."<br /><br />";
 

 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_GET['nome']) ||
 
        !isset($_GET['email']) ||
 
        !isset($_GET['texto'])) {
 
        died('Por favor, preencha todos os campos antes de enviar a mensagem.');       
 
    }
 
     
 
    $first_name = $_GET['nome']; // required
 
    $email_from = $_GET['email']; // required
 
    $comments = $_GET['texto']; // required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'O endereço de e-mail informado não é válido.<br />';
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 

  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "Contato feito pelo site gaivota.org:\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "Nome: ".clean_string($first_name)."\n";
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Texto: ".clean_string($comments)."\n";
 
     
 
     
 
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);  
 

echo '<section class="banner share"><h2>Obrigado por entrar em contato. Responderemos em breve!</h2></section>';

}
else {
echo '<section class="banner share"><h2>Por favor, preencha todos os campos do formulário</h2></section>';

include("fale-conosco.php");
}

?>
<?php include("_footer.php") ?>

