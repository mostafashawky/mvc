
<div class="group-add">
<h4 class="title"><?= $group_form_title ?></h4>
    <form method="post" class="group-form">
        <div class="form-group">
            <input class="group-input" name="group_name" autocomplete="off" placeholder = "<?= $group_form_name ?>"required>
        </div>
        <?php
        if( !empty($privileges) ):
        foreach( $privileges as $privilege ):
        ?>
        <div class="form-group">
            <label class="label-privilege" class="label-form">
            <div class="checkbox d-inline-block">
                <input id="<?= $privilege->privilege_id ?>" class="checkbox-privilege" type="checkbox" name="privileges[]" value="<?= $privilege->privilege_id ?>" >
                <span class='customize-checkbox'></span>
                <label class="label-privilege-name" for="<?= $privilege->privilege_id ?>"><?= $privilege->privilege_name ?> </label>
            </div>
            </label>
        </div>
        <?php
        endforeach;
        else:
        endif;   
        ?>
        <div class="form-group">
            <input class="submit-btn" type="submit" value="اضافه المجموعه">
        </div>
    </form>
</div>