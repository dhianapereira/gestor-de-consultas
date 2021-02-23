<?php

namespace app\components;

class Button
{
    private $title;
    private $style;
    private $onPressed;

    function __construct($title, $style, $onPressed)
    {
        $this->title = $title;
        $this->style = $style;
        $this->onPressed = $onPressed;
    }

    function getButton()
    {
?>
        <a class="<?php echo ($this->style); ?>" href="?page=<?php echo ($this->onPressed); ?>">
            <?php echo ($this->title); ?>
        </a>
<?php
    }
}
