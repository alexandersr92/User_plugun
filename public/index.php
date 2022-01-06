<?php
require_once  substr( plugin_dir_path(__FILE__), 0, -7).'/src/data/UserRepository.php';
require_once  substr( plugin_dir_path(__FILE__), 0, -7).'/src/components/Table.php';

$colums = array(
    'id' => 'ID',
    'name' => 'Name',
    'username' => 'Username',
    'email' => 'Email',
    'website' => 'Website',
);

$repository = new UserRepository();
$table = new Table($colums);
$users = $repository->getAll();

get_header();
?>
    <div class="container">
        <?php echo $table->render($users); ?>
    </div>
<?php


//var_dump($API);
get_footer();