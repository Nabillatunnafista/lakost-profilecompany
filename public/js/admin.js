document.addEventListener('DOMContentLoaded', () => {

    /* --- SIDEBAR TOGGLE --- */
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const adminMain = document.getElementById('adminMain');

    if (sidebarToggle && sidebar && adminMain) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            adminMain.classList.toggle('expanded');
        });
    }

    /* --- TAB NAVIGATION --- */
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.dataset.tab;

            tabButtons.forEach(b => b.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));

            this.classList.add('active');
            const targetContent = document.getElementById('tab-' + targetId);
            if (targetContent) {
                targetContent.classList.add('active');
            }
        });
    });
});

/* --- MODAL FUNCTIONS --- */
function openModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.style.display = 'flex';
        setTimeout(() => { modal.classList.add('active'); }, 10);
        document.body.style.overflow = 'hidden';
    }
}

function closeModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.classList.remove('active');
        setTimeout(() => { modal.style.display = 'none'; }, 300);
        document.body.style.overflow = '';
    }
}

/* --- LOGOUT & DELETE --- */
function confirmLogout() {
    Swal.fire({
        title: 'Yakin mau keluar?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#052659',
        confirmButtonText: 'Ya, Logout!'
    }).then((result) => {
        if (result.isConfirmed) { document.getElementById('logout-form').submit(); }
    });
}

function confirmDelete(url, label) {
    Swal.fire({
        title: 'Hapus ' + label + '?',
        text: 'Data tidak bisa dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = url;
            form.innerHTML = `<input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}"><input type="hidden" name="_method" value="DELETE">`;
            document.body.appendChild(form);
            form.submit();
        }
    });
}