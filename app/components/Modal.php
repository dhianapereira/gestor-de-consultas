<?php

namespace app\components;

class Modal
{

    public static function registerRoom($action)
    {
?>
        <div class="modal-overlay">
            <div class="modal">
                <div class="form">
                    <h2>Cadastrar nova sala</h2>
                    <form method="POST" action="<?php echo ($action); ?>">
                        <div class="input-block">
                            <label class="sr-only" for="type">Tipo de Sala</label>
                            <input id="type" name="type" placeholder="Sala de ..." required>
                        </div>
                        <div class="input-block actions">
                            <a href="#" onclick="Modal.close()" class="button-cancel">Cancelar</a>
                            <button type="submit" class="primary-button">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php
    }
}
