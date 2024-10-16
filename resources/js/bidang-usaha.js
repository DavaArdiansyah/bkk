const bidangUsahaSelect = document.getElementById('bidang-usaha');
    const newOptionInput = document.getElementById('option-lainnya');

    function handleNewOptionInput() {
        const newOptionValue = newOptionInput.value.trim();
        if (newOptionValue) {
            // Buat elemen option baru
            const newOption = document.createElement('option');
            newOption.value = newOptionValue;
            newOption.textContent = newOptionValue;

            // Tambahkan option baru ke dalam select
            bidangUsahaSelect.appendChild(newOption);
            bidangUsahaSelect.value = newOptionValue;

            // Reset input field
            newOptionInput.value = '';
            newOptionInput.classList.add('d-none');
            bidangUsahaSelect.classList.remove('d-none');
        }
    }

    bidangUsahaSelect.addEventListener('change', function() {
        if (this.value === 'tambah') {
            this.classList.add('d-none');
            newOptionInput.classList.remove('d-none');
            newOptionInput.focus();
        } else {
            newOptionInput.classList.add('d-none');
            this.classList.remove('d-none');
        }
    });

    newOptionInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            handleNewOptionInput();
        }
    });

    newOptionInput.addEventListener('blur', function() {
        handleNewOptionInput();
    });
