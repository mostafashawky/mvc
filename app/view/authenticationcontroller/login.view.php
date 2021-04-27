<?php 
$errors = $this->messenger->getMessage();
if(  !empty($errors)){
  foreach( $errors as $error ) {
    ?>
    <p class='message t<?= $error[1]?>'><?= $error[0]?></p>
    <?php
  }
}
?>
<div class = "loginform">
    <div class="image">
        <img src="/img/login.png">
    </div>
    <form method = "post" action="<?php $_SERVER['PHP_SELF']?>">
      <div class="form-group">
        <input type="text" name="username" class="input-form" placeholder="اسم المستخدم">
      </div>
      <div class="form-group">
        <input type="password" name="password" class="input-form" placeholder="كلمه السر">
      </div>
      <div class="form-group">
        <input type="submit" class="btn-submit" value="تسجيل الدخول ">
      </div>
    </form>
</div>
