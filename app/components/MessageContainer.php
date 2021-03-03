<?php
class MessageContainer
{

    public static function errorMessage($title, $message)
    {
?>
        <div class="card-container">
            <div class="card">
                <h3>
                    <span><?php echo ($title); ?></span>
                    <img src="./public/styles/img/error.svg" alt="Imagem de mensagem de erro">
                </h3>
                <p><?php echo ($message); ?></p>
            </div>
        </div>
    <?php
    }

    public static function successMessage($title, $message)
    {
    ?>
        <div class="card-container">
            <div class="card">
                <h3>
                    <span><?php echo ($title); ?></span>
                    <img src="./public/styles/img/success.svg" alt="Imagem de mensagem de sucesso">
                </h3>
                <p><?php echo ($message); ?></p>
            </div>
        </div>
<?php
    }
}
