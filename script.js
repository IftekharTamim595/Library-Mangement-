// Function to handle registration and store data in the database
function redirectToLogin(event) {
    event.preventDefault(); // Prevent the default form submission behavior

    const form = document.getElementById('registerForm');
    const formData = new FormData(form);

    // Convert FormData to JSON
    const formJSON = JSON.stringify(Object.fromEntries(formData.entries()));

    fetch('/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json' // Send JSON data
        },
        body: formJSON, // Send the JSON object
    })
    .then(response => {
        // If the response is not OK, throw an error with the response text
        if (!response.ok) {
            return response.text().then(errorText => {
                throw new Error(errorText);
            });
        }
        return response.json(); // If OK, return the response as JSON
    })
    .then(responseData => {
        console.log('Response:', responseData);  // Log the response data

        if (responseData.success) {
            alert('Registration successful!');
        } else {
            alert('Registration failed. Please try again.');
        }
    })
    .catch(error => {
        // Detailed error logging
        console.error('Error:', error);  // Log the full error object
        console.error('Error Message:', error.message);  // Log the error message
        if (error.stack) {
            console.error('Error Stack:', error.stack);  // Log the stack trace if available
        }

        // Additional handling based on the error message
        alert('An error occurred. Please check the console for more details.');
    });
}
