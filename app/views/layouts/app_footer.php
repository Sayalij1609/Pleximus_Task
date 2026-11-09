        </main>
    </div>
</div>

<!-- Global Delete Student Confirmation Modal -->
<div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deleteStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
            <div class="modal-header border-0 pb-0">
                <div class="d-flex align-items-center gap-2 text-danger">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-danger-subtle text-danger" style="width: 40px; height: 40px;">
                        <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                    </span>
                    <h5 class="modal-title fw-bold mb-0" id="deleteStudentModalLabel">Confirm Student Deletion</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3">
                <p class="text-muted mb-2">
                    Are you sure you want to permanently remove
                    <strong class="text-dark" id="deleteStudentNameLabel">this student</strong>?
                </p>
                <div class="small text-secondary fw-semibold mb-1" id="deleteStudentRollLabel"></div>
                <p class="small text-danger mb-0">
                    This action cannot be undone.
                </p>
            </div>
            <div class="modal-footer border-0 pt-1">
                <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancel</button>
                <form action="<?= BASE_PATH ?>/students/delete" method="POST" class="m-0">
                    <input type="hidden" name="id" id="deleteStudentIdInput" value="">
                    <input type="hidden" name="csrf_token" value="<?= e($layoutCsrfToken) ?>">
                    <button type="submit" class="btn btn-danger d-inline-flex align-items-center gap-1">
                        <i class="bi bi-trash3-fill"></i>
                        <span>Yes, Delete Student</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_PATH ?>/assets/js/app.js"></script>
</body>
</html>
