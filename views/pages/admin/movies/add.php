<?php
/**
 * @var View $view
 * @var Session $session
 */

use App\Kernel\Session\Session;
use App\Kernel\View\View;
?>


<?php $view->component('start') ?>
    <h1>Add movie page</h1>

<form action="/admin/movies/add" method="post">
    <p>Name</p>
    <div>
        <label>
            <input type="text" name="name">
        </label>
    </div>
    <?php if ($session->has('name')) { ?>
    <ul>
        <?php foreach ($session->getFlash('name') as $error) {?>
        <li style="color: red;"><?php echo $error ?></li>
        <?php } ?>
    </ul>
    <?php } ?>
    <div>
        <button>
            Add
        </button>
    </div>
</form>
<?php $view->component('end');?>