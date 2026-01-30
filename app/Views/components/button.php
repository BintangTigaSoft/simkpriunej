<div class="mt-5">
    <button 
        type="<?= $type ?? 'submit' ?>" 
        class="btn btn-lg btn-primary w-100"
        onclick="if(this.closest('form').checkValidity()) { this.disabled = true; this.innerHTML = '<span class=\'spinner-border spinner-border-sm me-2\' role=\'status\' aria-hidden=\'true\'></span>Loading...'; this.closest('form').submit(); }"
    >
        <?= $text ?? 'Submit' ?>
    </button>
</div>
