<?php

namespace app\components;

class Button
{
    public static function show($title, $style, $onPressed)
    {
?>
        <a class="<?php echo ($style); ?>" href="?page=<?php echo ($onPressed); ?>">
            <?php echo ($title); ?>
        </a>
<?php
    }
}
