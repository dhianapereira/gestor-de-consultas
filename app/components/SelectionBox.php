<?php

namespace app\components;

class SelectionBox
{
    public static function months($months)
    {
?>
        <div class="custom-select">
            <select id="months" name="months" required>
                <option disabled selected>Escolha o mês</option>
                <?php
                $size = count($months["months"]);
                for ($i = 0; $i < $size; $i++) {
                ?>
                    <option value="<?php echo ($months["days"][$i]); ?>"><?php echo ($months["months"][$i]); ?></option>
                <?php
                }
                ?>

            </select>

        </div>

        <script src="../../../public/scripts/selection_box.js"></script>
<?php

    }
}
