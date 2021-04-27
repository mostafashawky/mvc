<div class="users-edit">
    <div class="container-fluid">
        <?php
        if( $msgs = $this->messenger->getMessage() ){
            foreach( $msgs as $msg ){
                echo "<p class='message t".$msg[1]."'>".$msg[0]."</p>";
            }
        }
        ?>
        <div class="breadcrumb">
           <a href="#"><?= $bread_crumb?></a>
        </div>
        <div class="users-form">
            <!-- Form Edit User -->
            <form class="form" method="post">
                <div class="form-group">
                    <label class="label-form"><?= $form_label_username ?></label>
                    <input class="input-form" type="text" name="username" value="<?= $this->checkRequest( "username", $user ) ?>">
                </div>
                <div class="form-group">
                    <div class="col">
                        <label class="label-form"><?= $form_label_password ?></label>
                        <input class="input-form" type="password" name="password"  value="<?= $this->checkRequest( "password", $user ) ?>">
                    </div>
                    <div class="col">
                        <label class="label-form"><?= $form_label_repassword ?></label>
                        <input class="input-form" type="password" name="repassword"  value="<?= $this->checkRequest( "password", $user ) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col">
                        <label class="label-form"><?= $form_label_email ?></label>
                        <input class="input-form" type="email" name="email"  value="<?= $this->checkRequest( "email", $user ) ?>">
                    </div>
                    <div class="col">
                        <label class="label-form"><?= $form_label_reemail ?> </label>
                        <input class="input-form" type="email" name="reemail" value="<?= $this->checkRequest("email", $user) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="label-form"><?= $form_label_group_id ?></label>
                    <select  class="input-form" name="group_id">
                        <option value=""><?= $form_selectbox ?></option>
                        <?php 
                        foreach( $groups as $group ){
                        ?>
                        <option value="<?= $group->group_id ?>" <?= ( $this->checkRequest("group_id", $user)  == $group->group_id) ? "selected" : '' ?>> <?= $group->group_name?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn-submit" value="<?= $form_edituser?>">
                </div>
            </form> 
        </div>
    </div>
</div>