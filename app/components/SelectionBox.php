<?php

namespace app\components;

class SelectionBox
{
    public static function months($title, $months_list, $days_list, $name)
    {
?>
        <div class="custom-select">
            <select name="<?php echo ($name); ?>" required>
                <option disabled selected><?php echo ($title); ?> </option>
                <?php

                foreach ($months_list as $month) {
                    foreach ($days_list as $days) {


                ?>
                        <option value="<?php echo ($days); ?>"><?php echo ($month); ?></option>
                <?php
                    break;
                    }
                    
                }
                ?>
                
            </select>
            

        </div>
           
<?php

    }
}
