<?php

namespace app\components;

class SelectionBox
{
    public static function months($months, $days)
    {
?>
        <div class="custom-select">
            <select id="months" name="months" required>
                <option disabled selected>Escolha o mês</option>
                <?php
                $size = count($months);
                for ($i = 0; $i < $size; $i++) {
                ?>
                    <option value="<?php echo ($days[$i]); ?>"><?php echo ($months[$i]); ?></option>
                <?php
                }
                ?>

            </select>

        </div>

        <script src="../../../public/scripts/selection_box.js"></script>
<?php

    }
}
