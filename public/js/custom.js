// Include custom js
document.addEventListener('livewire:init', () => {
    Livewire.on('toast', (data) => {
        const toastElement = document.getElementById('toast');
        toastElement.querySelector('#toast-title-text').textContent = data[0]
        toastElement.querySelector('#toast-body-text').innerHTML = data[1]

        const toast = new bootstrap.Toast(toastElement);
        toast.show();
    });
});
