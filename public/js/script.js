// Seleksi elemen tombol edit dan simpan
const editButton = document.querySelector('#editButton');
const checkIconContainer = document.querySelector('.checkIconContainer');
const saveEditProfile = document.querySelector('.saveEditProfile');

// Event listener untuk tombol edit
editButton.addEventListener('click', function() {
    toggleEditMode();
});

// Event listener untuk tombol save/check
saveEditProfile.addEventListener('click', function() {
    saveProfileData();
});

// Fungsi untuk toggle edit mode
function toggleEditMode() {
    const elements = [
        { display: 'usernameDisplay', input: 'usernameInput' },
        { display: 'emailDisplay', input: 'emailInput' },
        { display: 'phoneDisplay', input: 'phoneInput' },
        { display: 'addressDisplay', input: 'addressInput' }
    ];

    elements.forEach(element => {
        const displayElem = document.getElementById(element.display);
        const inputElem = document.getElementById(element.input);

        // Toggle tampilan elemen
        if (displayElem.style.display === 'none') {
            displayElem.style.display = 'block';
            inputElem.style.display = 'none';
        } else {
            displayElem.style.display = 'none';
            inputElem.style.display = 'block';
        }
    });

    // Toggle ikon edit dan close (X)
    if (editButton.classList.contains('fa-edit')) {
        editButton.classList.remove('fa-edit');
        editButton.classList.add('fa-times');
        checkIconContainer.style.display = 'block'; // Tampilkan ikon check
    } else {
        editButton.classList.remove('fa-times');
        editButton.classList.add('fa-edit');
        checkIconContainer.style.display = 'none'; // Sembunyikan ikon check
    }
}

// Fungsi untuk menyimpan data profil
// Fungsi untuk menyimpan data profil
function saveProfileData() {
    // Ambil data dari input field
    const updatedData = {
        username: document.getElementById('usernameInput').value,
        email: document.getElementById('emailInput').value,
        phone: document.getElementById('phoneInput').value,
        address: document.getElementById('addressInput').value
    };

    // Kirim data ke server menggunakan fetch API (AJAX)
    fetch('/profile/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
        },
        body: JSON.stringify(updatedData)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');  
        }
        return response.json();  
    })
    .then(data => {
        console.log(data);  
        if (data.success) { 
            document.getElementById('usernameDisplay').innerText = updatedData.username;
            document.getElementById('emailDisplay').innerText = updatedData.email;
            document.getElementById('phoneDisplay').innerText = updatedData.phone;
            document.getElementById('addressDisplay').innerText = updatedData.address;

            toggleEditMode();  
            alert('Data berhasil diperbarui!');
        } else {
            alert('Gagal menyimpan data: ' + data.message);  
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan, coba lagi');  
    });
}

