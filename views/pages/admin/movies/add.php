<?php
/**
 * @var View $view
 */

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
    <div>
        <button>
            Add
        </button>
    </div>
</form>
<?php $view->component('end');?>