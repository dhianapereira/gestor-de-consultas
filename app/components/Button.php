<?php
class Button
{
    public static function show($title, $style, $onPressed)
    {
?>
        <a class="<?php echo ($style); ?>" href="?index=<?php echo ($onPressed); ?>">
            <?php echo ($title); ?>
        </a>
<?php
    }
}
