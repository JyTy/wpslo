<h3>Kategorije</h3>
<ul>
<?php
    // Get all non-empty taxonomies
    $args = array(
        'type'                     => 'wplugins',
        'taxonomy'                 => 'wplugcat',
        'orderby'                  => 'name',
        'order'                    => 'ASC',
        'hide_empty'               => 1
    ); 
    $taxonomies = get_categories($args);

    foreach ($taxonomies as $taxonomy) {
        // Print taxonomy name and desc
?>
    <li>
        <a href="#<?=$taxonomy->slug?>"><?=$taxonomy->name?></a>
    </li>
<?php
    } // End foreach
?>
</ul>