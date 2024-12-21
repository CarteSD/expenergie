function closeModal() {
    let background = document.getElementById('modal-background');
    let modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (!modal.classList.contains('hidden')) {
            modal.classList.add("hidden");
        }
    })
    background.classList.add("hidden");
}

function showModal(e) {
    let background = document.getElementById('modal-background');
    let modal = document.getElementById(`modal_${e.id}`);
    modal.classList.remove("hidden");
    background.classList.remove("hidden");
}