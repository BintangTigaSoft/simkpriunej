<?php $value = $value ?? null; ?>
<?php $extraattribute = $extraattribute ?? ''; ?>
<?php $type = $type ?? 'text'; ?>
<?php $isPassword = $type === 'password'; ?>

<div class="d-block">
    <?php if (isset($label)): ?>
        <label class="form-label" for="<?= $name ?>"><?= $label ?></label>
    <?php endif; ?>

    <?php if ($isPassword): ?>
    <div class="input-group has-validation">
    <?php endif; ?>

    <input
        type="<?= $type ?>"
        class="form-control <?= validation_show_error($name) ? 'is-invalid' : '' ?>"
        placeholder="<?= $placeholder ?? '' ?>"
        value="<?= old($name, $value) ?>"
        name="<?= $name ?>"
        id="<?= $name ?>"
        <?= $extraattribute ?>
    >

    <?php if ($isPassword): ?>
        <span class="input-group-text" style="cursor: pointer;" onclick="(function(el){
            const input = document.getElementById('<?= $name ?>');
            const icon = el.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('feather-eye');
                icon.classList.add('feather-eye-off');
            } else {
                input.type = 'password';
                icon.classList.remove('feather-eye-off');
                icon.classList.add('feather-eye');
            }
        })(this)">
            <i class="feather-eye"></i>
        </span>
    <?php endif; ?>

    <div class="invalid-feedback">
        <?= validation_show_error($name) ?>
    </div>

    <?php if ($isPassword): ?>
    </div>
    <?php endif; ?>
</div>
