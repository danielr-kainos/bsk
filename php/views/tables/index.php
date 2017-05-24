<div class="row">
    <?php
    function generateButton($table, $text, $enabled)
    {
        if ($enabled)
            return '<a href="?controller=tables&action=details&table=' . $table . '" class="collection-item">' . $text . '</a>';
        else
            return '<a class="collection-item grey-text">' . $text . '</a>';
    }

    foreach ($tables as $name => $label)
        echo '<div class="col s12 m4">'
            . '<a href="?controller=tables&action=details&table=' . $name . '">'
            . '<div class="card-panel">'
            . '<h5>' . $name . '</h5>'
            . '<div class="collection">'
            . generateButton($name, 'SELECT', User::getCurrentUser()->label >= $label)
            . generateButton($name, 'INSERT', User::getCurrentUser()->label <= $label)
            . generateButton($name, 'UPDATE', User::getCurrentUser()->label == $label)
            . generateButton($name, 'DELETE', User::getCurrentUser()->label == $label)
            . '</div></div></a></div>'
    ?>
</div>
