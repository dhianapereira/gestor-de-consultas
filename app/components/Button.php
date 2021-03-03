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
}
