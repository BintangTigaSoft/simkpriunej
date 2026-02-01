<form id="menuForm">
    <input type="hidden" name="id" id="id">
    
    <div class="mb-3">
        <label class="form-label">Menu Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="e.g. Dashboard" required>
        <div class="invalid-feedback"></div>
    </div>
    
    <div class="mb-3">
        <label class="form-label">URL Path</label>
        <div class="input-group">
            <span class="input-group-text"><?= base_url() ?>/</span>
            <input type="text" class="form-control" name="url" id="url" placeholder="dashboard">
        </div>
        <div class="form-text">Leave empty for parent menu with dropdown</div>
        <div class="invalid-feedback"></div>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Icon Class</label>
        <input type="text" class="form-control" name="icon" id="icon" placeholder="feather-circle">
        <div class="form-text">Check <a href="https://feathericons.com/" target="_blank">Feather Icons</a> for reference</div>
        <div class="invalid-feedback"></div>
    </div>
</form>
