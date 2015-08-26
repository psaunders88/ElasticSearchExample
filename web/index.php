<?php

require_once '../vendor/autoload.php';
require_once '../app/bootstrap.php';

if (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) {
    $return = $services['product_search']->search('Sit');
}

?>

<form action="/" method="GET">
    <label>Search terms</label> <input type="text" name="search" value="<?php if (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) { echo $_REQUEST['search']; } ?>"/>
    <input type="submit" value="Search"/>
</form>

<table>
    <thead>
        <th>Name</th>
        <th>Description</th>
    </thead>
    <tbody>
        <?php if (isset($_REQUEST['search']) && !empty($_REQUEST['search'])): ?>
            <?php foreach ($return['hits']['hits'] as $product) : ?>
                    <tr>
                        <td><img style="width:200px;" src="<?php echo($product['_source']['image']); ?>"/></td>
                        <td>
                            <?php echo($product['_source']['name']); ?>
                            <hr/>
                            <?php echo($product['_source']['description']); ?>
                        </td>
                    </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No results</p>
        <?php endif; ?>
    </tbody>
</table>