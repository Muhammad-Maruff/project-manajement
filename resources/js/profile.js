const editButton = document.querySelector('#editButton');
const checkIconContainer = document.querySelector('.checkIconContainer');
const saveEditProfile = document.querySelector('.saveEditProfile');
const profileImageContainer = document.getElementById('profileImageContainer');
const profileImageInput = document.getElementById('profileImageInput');
const editImageButton = document.getElementById('editImageButton');
const profileImage = document.getElementById('profileImage');  
const loading = document.getElementById('loadingSpinner');

profileImageInput.disabled = true;

editButton.addEventListener('click', function () {
    toggleEditMode();
});

saveEditProfile.addEventListener('click', function () {
    saveProfileData();
});

profileImageContainer.addEventListener('mouseover', function () {
    if (!profileImageInput.disabled) {
        profileImageInput.style.display = 'block';
    }
});

profileImageContainer.addEventListener('mouseleave', function () {
    if (!profileImageInput.files.length) {  
        profileImageInput.style.display = 'none';
    }
});

profileImageInput.addEventListener('change', function () {
    const file = profileImageInput.files[0];  
    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            profileImage.src = e.target.result;  
        };

        reader.readAsDataURL(file); 
    }
});

function toggleEditMode() {
    const elements = [
        { display: 'usernameDisplay', input: 'usernameInput' },
        { display: 'emailDisplay',    input: 'emailInput' },
        { display: 'phoneDisplay',    input: 'phoneInput' },
        { display: 'addressDisplay',  input: 'addressInput' }
    ];

    elements.forEach(element => {
        const displayElem = document.getElementById(element.display);
        const inputElem = document.getElementById(element.input);

        if (displayElem.style.display === 'none') {
            displayElem.style.display = 'block';
            inputElem.style.display   = 'none';
        } else {
            displayElem.style.display = 'none';
            inputElem.style.display   = 'block';
        }
    });

    if (editButton.classList.contains('fa-edit')) {
        editButton.classList.remove('fa-edit');
        editButton.classList.add('fa-times');
        checkIconContainer.style.display = 'block';

        profileImageInput.disabled = false;
        profileImageContainer.classList.add('edit-mode'); 
    } else {
        editButton.classList.remove('fa-times');
        editButton.classList.add('fa-edit');
        checkIconContainer.style.display = 'none';

        profileImageInput.disabled       = true;
        profileImageInput.style.display  = 'none';  
        profileImageContainer.classList.remove('edit-mode');  
    }
}

function triggerFileInput() {
    if (!profileImageInput.disabled) {
        profileImageInput.click();  
    }
}

function saveProfileData() {
    const updatedData = {
        username  : document.getElementById('usernameInput').value,
        email     : document.getElementById('emailInput').value,
        phone     : document.getElementById('phoneInput').value,
        address   : document.getElementById('addressInput').value,
        image     : profileImageInput.files[0] 
    };

    const formData = new FormData();
    for (let key in updatedData) {
        formData.append(key, updatedData[key]);
    }

    loading.style.display = 'flex';

    fetch('/profile/update', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        loading.style.display = 'none';

        if (data.success) {
            document.getElementById('usernameDisplay').innerText = updatedData.username;
            document.getElementById('emailDisplay').innerText    = updatedData.email;
            document.getElementById('phoneDisplay').innerText    = updatedData.phone;
            document.getElementById('addressDisplay').innerText  = updatedData.address;
            if (updatedData.image) {
                document.getElementById('profileImage').src = URL.createObjectURL(updatedData.image);
            }
            toggleEditMode();
            Swal.fire({
                imageUrl: '/images/Add files-bro.png',
                imageWidth: 300,
                imageHeight: 300,
                title: 'SUCCESS !',
                text: data.message,
                showConfirmButton: true,
                customClass: {
                    popup: 'custom-swal-popup',
                    confirmButton: 'custom-swal-confirm-button-success',
                    title: 'swal2-title-success',
                }
            });
        } else {
            Swal.fire({
                imageUrl: '/images/Questions-cuate.png',
                imageWidth: 300,
                imageHeight: 300,
                title: 'FAILED !',
                text: 'Profile update failed. Please try again.',
                footer: '<ul>' + Object.values(data.errors).map(errors => `<li>${errors[0]}</li>`).join('') + '</ul>',
                showConfirmButton: true,
                customClass: {
                    popup: 'custom-swal-popup',
                    confirmButton: 'custom-swal-confirm-button-error',
                    title: 'swal2-title-failed',
                },
            });
        }
    })
    .catch(error => {
        loading.style.display = 'none';

        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: error.message,
            showConfirmButton: true,
            color: '#2AD641',
            customClass: {
                popup: 'custom-swal-popup',
                confirmButton: 'custom-swal-confirm-button',
            },
        });
    });
}
