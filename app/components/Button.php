<?php
class Button
{
    public static function show($title, $style, $onPressed)
    {
?>
        <a class="<?php echo ($style); ?>" href="<?php echo ($onPressed); ?>">
            <?php echo ($title); ?>
        </a>
    <?php
    }

    public static function quickAccess($route, $title, $image, $alt)
    {
    ?>
        <a href="<?php echo ($route); ?>" class="home-button">
            <h3>
                <p><?php echo ($title); ?> </p>
                <img src="<?php echo ($image); ?>" alt="<?php echo ($alt); ?>" />
            </h3>
        </a>
<?php
    }
}
