<div class="users">
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
            <!-- Form Add New User -->
            <form class="form" method="post">
                <div class="form-group">
                    <label class="label-form"><?= $form_label_username ?></label>
                    <input class="input-form" type="text" name="username" value="<?= $this->checkRequest( "username" ) ?>">
                </div>
                <div class="form-group">
                    <div class="col">
                        <label class="label-form"><?= $form_label_first_name ?></label>
                        <input class="input-form" type="text" name="first_name" value="<?= $this->checkRequest( "first_name" ) ?>">
                    </div>
                    <div class="col">
                        <label class="label-form"><?= $form_label_last_name ?></label>
                        <input class="input-form" type="text" name="last_name" value="<?= $this->checkRequest( "last_name" ) ?>">
                    </div>
                   
                </div>
                <div class="form-group">
                    <div class="col">
                        <label class="label-form"><?= $form_label_password ?></label>
                        <input class="input-form" type="password" name="password"  value="<?= $this->checkRequest( "password" ) ?>">
                    </div>
                    <div class="col">
                        <label class="label-form"><?= $form_label_repassword ?></label>
                        <input class="input-form" type="password" name="repassword"  value="<?= $this->checkRequest( "repassword" ) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col">
                        <label class="label-form"><?= $form_label_email ?></label>
                        <input class="input-form" type="email" name="email"  value="<?= $this->checkRequest( "email" ) ?>">
                    </div>
                    <div class="col">
                        <label class="label-form"><?= $form_label_reemail ?> </label>
                        <input class="input-form" type="email" name="reemail" value="<?= $this->checkRequest("reemail") ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="label-form"><?= $form_label_phone ?></label>
                    <input class="input-form" type="number" name="phone"  value= "<?= $this->checkRequest( "phone" ) ?>">
                </div>
                <div class="form-group">
                    <label class="label-form"><?= $form_label_group_id ?></label>
                    <select  class="input-form" name="group_id">
                        <option value=""><?= $form_selectbox ?></option>
                        <?php 
                        foreach( $groups as $group ){
                        ?>
                        <option value="<?= $group->group_id ?>" <?= ( $this->checkRequest("group_id")  == $group->group_id) ? "selected" : '' ?>> <?= $group->group_name?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn-submit" value="<?= $form_adduser?>">
                </div>
            </form> 
        </div>
    </div>
</div>