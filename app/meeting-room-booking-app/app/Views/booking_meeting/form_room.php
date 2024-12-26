<div class="container">
    <h2><?= isset($room) ? 'Edit Room' : 'Add Room' ?></h2>
    <form action="<?= isset($room) ? '/room/edit/' . $room['id'] : '/room/add' ?>" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Room Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= isset($room) ? $room['name'] : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?= isset($room) ? $room['description'] : '' ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary"><?= isset($room) ? 'Update Room' : 'Add Room' ?></button>
        <a href="/booking" class="btn btn-secondary">Cancel</a>
    </form>
</div>