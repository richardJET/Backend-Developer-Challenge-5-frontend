const editProfileButton = document.getElementById('editProfileButton');
const profileUpdateForm = document.getElementById('profileUpdateForm')
const profileImage = document.getElementById('profileImage');
const profileDescription = document.getElementById('profileDescription');
const profileName = document.getElementById('profileName');
const email = document.getElementById('email')


// Function to toggle visibility of the update form
function toggleUpdateForm() {
    profileUpdateForm.style.display = profileUpdateForm.style.display === 'none' ? 'block' : 'none';
}

// Event listener for edit profile button
editProfileButton.addEventListener('click', () => {
    toggleUpdateForm();
});


fetch('http://localhost:3001/getProfile', {
    credentials: "include"
})
    .then(response => response.json())
    .then(data => {
        profileName.innerHTML = data.displayName
        profileImage.src = data.profile_photo;
        profileDescription.textContent = data.description;
        email.value = data.email;
    })
    .catch(error => {
        console.error('Error fetching profile data:', error);
    });

