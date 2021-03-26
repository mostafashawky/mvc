<div class="privilege-edit">
    <h4 class='title'>تعديل الصلاحية</h4>
    <form method="post" class="form-privilege-edit">
        <div class="form-group">
            <input class="input-form-line" name="privilege_name" autocomplete="off" value="<?= $privilege->privilege_name?>">
        </div>
        <div class="form-group">
            <input class="input-form-line" name="privilege_url" autocomplete="off" value="<?= $privilege->privilege_url?>">
        </div>
        <div class="form-group">
            <input type="submit" class="btn-submit" value="تعديل الترخيص">
        </div>
    </form>
</div>