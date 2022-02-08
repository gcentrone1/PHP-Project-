<?php
echo password_hash('testhidran', PASSWORD_DEFAULT);
?>
<form encytpe="multipart/form-data" id="updateForm" action="controller/updateRecord.php" method="POST">
    <div class="form-group">
        <input type="hidden" name="id" value="<?= $user['id'] ?>"> </input>
        <input type="hidden" name="action" value="<?= $user['id'] ? 'store' : 'save' ?>"> </input>
        <label for="username" class="col-sm-2 col-form-label text-dark">Full Name</label>
        <div class="col-sm-10">
            <input required type="text" class="form-control" name="username" id="username" placeholder="User Name" value=<?= $user['username'] ?>>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 col-form-label text-dark">Email</label>
            <div class="col-sm-10">
                <input required type="email" class="form-control" name="email" id="email" placeholder="Email" value=<?= $user['email'] ?>>
            </div>
            <div class="form-group">
                <label for="fiscalcode" class="col-sm-2 col-form-label text-dark">Fiscalcode</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control" name="fiscalcode" id="fiscalcode" placeholder="Fiscal Code" value=<?= $user['fiscalcode'] ?>>
                </div>
            </div>
            <div class="form-group">
                <label for="age" class="col-sm-2 col-form-label text-dark">Age</label>
                <div class="col-sm-10">
                    <input required type="number" min="0" max="120" class="form-control" name="age" id="age" placeholder="Age" value=<?= $user['age'] ?>>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 col-form-label text-dark">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control form-control-lg" value="" name="password" id="password" placeholder="password">
                </div>
            </div>
            <div class="form-group row">
                <label for="roletype" class="col-sm-2 col-form-label text-dark">Role</label>
                <div class="col-sm-10">
                    <select name="roletype" id="roletype">
                        <?php
                        foreach (getConfig('roletypes', []) as $role) :
                            $sel = $user['roletype'] === $role ? 'selected' : '';
                            echo "\n<option $sel value='$role'>$role</option>";
                        endforeach;


                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group row mt-5">

                <div class="col-auto">
                    <a href="<?= $deleteUrl ?>?id=<?= $user['id'] ?>&action=delete" onclick="return confirm('DELETE USER?')" class="btn btn-danger"> <i class="fa fa-trash"> </i>

                        DELETE
                    </a>
                </div>
                <div class="col-auto">
                    <button class="btn btn-success">
                        <i class="fa fa-pen"></i> <?= $user['id'] ? 'UPDATE' : 'INSERT' ?>

                    </button>
                </div>
            </div>
</form>