<div class="add-employee">
    <h1 class="title"><?= $form_employee_title ?></h1>
    <form class = "add-form" action = "<?php $_SERVER['PHP_SELF']?>" method = "post">
        <input type= "text" class="input-form" name="username" autocomplete="off" placeholder="<?= $form_input_name?>">
        <input type="email" class="input-form" name="email" autocomplete="off" placeholder="<?= $form_input_email ?>">
        <input type="text" class="input-form" name="fullname" autocomplete="off" placeholder="<?= $form_input_fullname ?>">
        <input type="number" class="input-form" name="salary" autocomplete="off" placeholder="<?= $form_input_salary ?>">
        <input type="submit" class="btn-submit" value="<?= $form_input_addemployee ?>">
    </form>
</div>