<div class="group-add">
    <form method="post" class="group-form">
        <div class="form-group">
            <label class="label-form">اسم المجموعة</label>
            <input class="input-form" name="group_name" required>
        </div>
        <?php
        if( !empty($privileges) ):
        foreach( $privileges as $privilege ):
        ?>
        <div class="form-group">
            <label for="check<?=$privilege->privilege_id ?>" class="label-form"><?= $privilege->privilege_name ?></label>
            <input type="checkbox" id="check<?=$privilege->privilege_id?>" value="<?= $privilege->privilege_id ?>">
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