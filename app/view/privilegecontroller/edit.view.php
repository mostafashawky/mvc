<div class="privilege-edit">
    <form method="post" class="form-privilege-edit">
        <div class="form-group">
            <label class="label-form">اسم الترخيص</label>
            <input class="input-form" name="privilege_name" autocomplete="off" value="<?= $privilege->privilege_name?>">
        </div>
        <div class="form-group">
            <label class="label-form">رابط الترخيص</label>
            <input class="input-form" name="privilege_url" autocomplete="off" value="<?= $privilege->privilege_url?>">
        </div>
        <div class="form-group">
            <input type="submit" class="btn-submit" value="تعديل الترخيص">
        </div>
    </form>
</div>