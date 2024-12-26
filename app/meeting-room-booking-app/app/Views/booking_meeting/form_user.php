<div class="container">
    <h2 class="mb-4">Tambah/Edit User</h2>
    <form action="<?= isset($user) ? '/user/edit/' . $user['id'] : '/user/add' ?>" method="post">
        <div class="mb-3">
            <label for="nik" class="form-label">NIK</label>
            <input type="text" class="form-control" id="nik" name="nik" value="<?= isset($user) ? $user['nik'] : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= isset($user) ? $user['name'] : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" <?= !isset($user) ? 'required' : '' ?>>
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
                <option value="admin" <?= isset($user) && $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="petugas" <?= isset($user) && $user['role'] == 'petugas' ? 'selected' : '' ?>>Petugas</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><?= isset($user) ? 'Update User' : 'Add User' ?></button>
    </form>
</div>