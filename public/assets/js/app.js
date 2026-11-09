document.addEventListener('DOMContentLoaded', function () {
    // 1. Mobile Sidebar Drawer Toggle
    const sidebar = document.getElementById('appSidebar');
    const backdrop = document.getElementById('sidebarBackdrop');
    const openBtn = document.getElementById('sidebarOpenBtn');
    const closeBtn = document.getElementById('sidebarCloseBtn');

    function openSidebar() {
        if (sidebar) sidebar.classList.add('show');
        if (backdrop) backdrop.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        if (sidebar) sidebar.classList.remove('show');
        if (backdrop) backdrop.classList.remove('show');
        document.body.style.overflow = '';
    }

    if (openBtn) openBtn.addEventListener('click', openSidebar);
    if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
    if (backdrop) backdrop.addEventListener('click', closeSidebar);

    // 2. Delete Confirmation Modal
    const deleteModalEl = document.getElementById('deleteStudentModal');
    const deleteIdInput = document.getElementById('deleteStudentIdInput');
    const deleteNameLabel = document.getElementById('deleteStudentNameLabel');
    const deleteRollLabel = document.getElementById('deleteStudentRollLabel');

    if (deleteModalEl && typeof bootstrap !== 'undefined') {
        const deleteModal = new bootstrap.Modal(deleteModalEl);

        document.querySelectorAll('.js-delete-student-btn').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const studentId = btn.getAttribute('data-student-id') || '';
                const studentName = btn.getAttribute('data-student-name') || 'this student';
                const studentRoll = btn.getAttribute('data-student-roll') || '';

                if (deleteIdInput) deleteIdInput.value = studentId;
                if (deleteNameLabel) deleteNameLabel.textContent = studentName;
                if (deleteRollLabel) {
                    deleteRollLabel.textContent = studentRoll ? 'Roll No: ' + studentRoll : '';
                }

                deleteModal.show();
            });
        });
    }

    // 3. Password Visibility Toggles
    document.querySelectorAll('.js-toggle-password').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const targetId = btn.getAttribute('data-target');
            const input = targetId ? document.getElementById(targetId) : null;
            const icon = btn.querySelector('i');

            if (!input) return;

            if (input.type === 'password') {
                input.type = 'text';
                if (icon) {
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                }
                btn.setAttribute('aria-label', 'Hide password');
            } else {
                input.type = 'password';
                if (icon) {
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
                btn.setAttribute('aria-label', 'Show password');
            }
        });
    });

    // 4. Live Password Strength & Confirmation Match Hint
    const newPasswordInput = document.querySelector('[data-password-strength]');
    const strengthBar = document.getElementById('passwordStrengthBar');
    const strengthText = document.getElementById('passwordStrengthText');

    if (newPasswordInput && strengthBar && strengthText) {
        newPasswordInput.addEventListener('input', function () {
            const val = newPasswordInput.value;
            let score = 0;

            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val) && /[a-z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            if (val.length === 0) {
                strengthBar.style.width = '0%';
                strengthBar.style.backgroundColor = '#e2e8f0';
                strengthText.textContent = 'Minimum 8 characters required';
                strengthText.className = 'form-text text-muted';
                return;
            }

            if (val.length < 8) {
                strengthBar.style.width = '25%';
                strengthBar.style.backgroundColor = '#ef4444';
                strengthText.textContent = 'Too short (must be at least 8 characters)';
                strengthText.className = 'form-text text-danger';
                return;
            }

            if (score <= 2) {
                strengthBar.style.width = '55%';
                strengthBar.style.backgroundColor = '#f59e0b';
                strengthText.textContent = 'Fair — add numbers or symbols for stronger security';
                strengthText.className = 'form-text text-warning';
            } else if (score === 3) {
                strengthBar.style.width = '80%';
                strengthBar.style.backgroundColor = '#3b82f6';
                strengthText.textContent = 'Good password strength';
                strengthText.className = 'form-text text-primary';
            } else {
                strengthBar.style.width = '100%';
                strengthBar.style.backgroundColor = '#10b981';
                strengthText.textContent = 'Strong password';
                strengthText.className = 'form-text text-success';
            }
        });
    }

    const confirmPasswordInput = document.querySelector('[data-password-confirm]');
    const matchHint = document.getElementById('passwordMatchHint');

    if (newPasswordInput && confirmPasswordInput && matchHint) {
        function updateMatchHint() {
            const pwd = newPasswordInput.value;
            const confirmPwd = confirmPasswordInput.value;

            if (confirmPwd === '') {
                matchHint.textContent = '';
                return;
            }

            if (pwd === confirmPwd) {
                matchHint.textContent = 'Passwords match';
                matchHint.className = 'form-text text-success fw-medium';
            } else {
                matchHint.textContent = 'Passwords do not match yet';
                matchHint.className = 'form-text text-danger fw-medium';
            }
        }

        newPasswordInput.addEventListener('input', updateMatchHint);
        confirmPasswordInput.addEventListener('input', updateMatchHint);
    }

    // 5. Focus Current Password input when Update Password section expands
    const passwordCollapseEl = document.getElementById('updatePasswordSection');
    const currentPwdInput = document.getElementById('currentPassword');
    if (passwordCollapseEl && currentPwdInput) {
        passwordCollapseEl.addEventListener('shown.bs.collapse', function () {
            currentPwdInput.focus();
            passwordCollapseEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        });
    }
});
