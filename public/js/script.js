function toggleEditMode() {
    const elements = [
        { display: 'usernameDisplay', input: 'usernameInput' },
        { display: 'emailDisplay', input: 'emailInput' },
        { display: 'phoneDisplay', input: 'phoneInput' },
        { display: 'addressDisplay', input: 'addressInput' }
    ];

    // Menampilkan atau menyembunyikan input field
    elements.forEach(element => {
        const displayElem = document.getElementById(element.display);
        const inputElem = document.getElementById(element.input);

        if (displayElem.style.display === 'none') {
            displayElem.style.display = 'block';
            inputElem.style.display = 'none';
        } else {
            displayElem.style.display = 'none';
            inputElem.style.display = 'block';
        }
    });

    // Mengubah ikon edit/times dan ikon fa-check
    const editIcon = document.getElementById('editIcon');
    const checkIconContainer = document.getElementById('checkIconContainer');

    if (editIcon.classList.contains('fa-edit')) {
        editIcon.classList.remove('fa-edit');
        editIcon.classList.add('fa-times');
        checkIconContainer.style.display = 'block'; // Tampilkan ikon fa-check
    } else {
        editIcon.classList.remove('fa-times');
        editIcon.classList.add('fa-edit');
        checkIconContainer.style.display = 'none'; // Sembunyikan ikon fa-check
    }
}