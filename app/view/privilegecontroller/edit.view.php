<div class="privilege-edit">
    <div class="breadcrumb"><?= $bread_crumb?></div>
    <div class="privilege-edit-container">
        <form method="post" class="form-privilege-edit">
            <div class="form-group">
                <label class="label-form"><?= $privilege_form_name?></label>
                <input class="input-form" name="privilege_name" autocomplete="off" value="<?= $privilege->privilege_name?>">
            </div>
            <div class="form-group">
                <label class="label-form"><?= $privilege_form_url?></label>
                <input class="input-form" name="privilege_url" autocomplete="off" value="<?= $privilege->privilege_url?>">
            </div>
            <div class="form-group">
            <input type="submit" class="btn-submit" value="تعديل الترخيص">
            </div>
        </form>
    </div>
</div