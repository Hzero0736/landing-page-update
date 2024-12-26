<div class="container">
    <h2><?= isset($meeting) ? 'Edit Booking' : 'Create Booking' ?></h2>
    <form action="<?= isset($meeting) ? '/booking/edit/' . $meeting['id'] : '/booking/save' ?>" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Meeting Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= isset($meeting) ? $meeting['title'] : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="<?= isset($meeting) ? $meeting['date'] : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="time" class="form-control" id="start_time" name="start_time" value="<?= isset($meeting) ? $meeting['start_time'] : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="end_time" class="form-label">End Time</label>
            <input type="time" class="form-control" id="end_time" name="end_time" value="<?= isset($meeting) ? $meeting['end_time'] : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="room_id" class="form-label">Meeting Room</label>
            <select class="form-select" id="room_id" name="room_id" required>
                <option value="">Select Room</option>
                <?php foreach ($rooms as $room): ?>
                    <option value="<?= $room['id'] ?>" <?= (isset($meeting) && $meeting['room_id'] == $room['id']) ? 'selected' : '' ?>><?= $room['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?= isset($meeting) ? $meeting['description'] : '' ?></textarea>
        </div>
        <div class="mb-3">
            <label for="user" class="form-label">User</label>
            <input type="text" class="form-control" id="user" name="user" value="<?= isset($meeting) ? $meeting['user'] : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="repeat" class="form-label">Repeat</label>
            <select class="form-select" id="repeat" name="repeat">
                <option value="none" <?= (isset($meeting) && $meeting['repeat'] == 'none') ? 'selected' : '' ?>>None</option>
                <option value="daily" <?= (isset($meeting) && $meeting['repeat'] == 'daily') ? 'selected' : '' ?>>Daily</option>
                <option value="weekly" <?= (isset($meeting) && $meeting['repeat'] == 'weekly') ? 'selected' : '' ?>>Weekly</option>
                <option value="monthly" <?= (isset($meeting) && $meeting['repeat'] == 'monthly') ? 'selected' : '' ?>>Monthly</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><?= isset($meeting) ? 'Update Booking' : 'Create Booking' ?></button>
    </form>
</div>