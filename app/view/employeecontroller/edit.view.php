
<style>
    * {
        box-sizing: border-box;
    }
    body {
        margin: 0px;
        padding: 0px;
        background-color: #eaeaea;
    }
    .add-employee {
        width: 420px;
        padding-right: 15px;
        padding-left: 15px;
        margin: 50px auto;
        text-align: center;
        background-color: #fff;
        box-shadow: 0px 0px 8px rgb(0 0 0 / 41%);
        overflow: hidden;
    }
    .add-employee .title {
        color: #6f6f6f;
        font-weight: bold;
        font-family: tahoma;
        margin: 33px 0px 26px;

    }
    .add-employee .add-form .input-form{
        display: block;
        padding: 10px 5px;
        width: 100%;
        margin-bottom: 20px;
        outline: none;
        border: none;
        border-bottom: 1px solid #eee;
        font-weight: bold;
        color: #999;

    }
    .add-employee .add-form .btn-submit {
        color: #fff;
        background-color: #0075ff;
        border: none;
        width: 100%;
        padding: 10px;
        cursor: pointer;
        margin: 28px 0px;
        font-size: 17px;
    }
</style>
<div class="add-employee">
    <h1 class="title">Edit Employee</h1>
    <form class = "add-form" action = "<?php $_SERVER['PHP_SELF']?>" method = "post">
        <input type= "text" class="input-form" name="username" autocomplete="off" value="<?= $employeeEdit->username ?>">
        <input type="email" class="input-form" name="email" autocomplete="off" value="<?=    $employeeEdit->email ?>">
        <input type="text" class="input-form" name="fullname" autocomplete="off" value="<?=  $employeeEdit->fullname ?>">
        <input type="number" class="input-form" name="salary" autocomplete="off" value="<?=  $employeeEdit->salary ?>">
        <input type="submit" class="btn-submit" value=" <?= $form_input_addemployee ?>">
    </form>
</div>