<?php

namespace app\components;

class MessageContainer
{

    public static function errorMessage($title, $image, $message)
    {
?>
        <div class="card">
            <h3>
                <span><?php echo ($title); ?></span>
                <img src="<?php echo ($image); ?>" alt="Imagem de mensagem de erro">
            </h3>
            <p><?php echo ($message); ?></p>
        </div>
    <?php
    }

    public static function successMessage($title, $image, $message)
    {
    ?>
        <div class="card">
            <h3>
                <span><?php echo ($title); ?></span>
                <img src="<?php echo ($image); ?>" alt="Imagem de mensagem de sucesso">
            </h3>
            <p><?php echo ($message); ?></p>
        </div>
<?php
    }
}
