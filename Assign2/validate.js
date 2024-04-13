window.onload = function() {
    const registrationForm = document.getElementById('registrationForm');

    registrationForm.addEventListener('submit', function(event) {
        event.preventDefault();
        let valid = true;
        
        // Validate each input field
        if (!validateTextFields()) valid = false;
        if (!validatePasswords()) valid = false;
        if (!validateFile()) valid = false;
        if (!validateDOB()) valid = false;

        // If all validations pass, submit the form
        if (valid) {
            this.submit();
        }
    });

    function validateTextFields() {
        const textInputs = document.querySelectorAll('input[type=text], input[type=email], input[type=tel], select, input[type=date]');
        let valid = true;

        textInputs.forEach(input => {
            if (input.value.trim() === '') {
                showError(input, 'This field is required');
                valid = false;
            } else {
                hideError(input);
            }
        });

        return valid;
    }

    function validatePasswords() {
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');
        let valid = true;

        if (password.value.trim() === '') {
            showError(password, 'Password is required');
            valid = false;
        } else if (password.value !== confirmPassword.value) {
            showError(confirmPassword, 'Passwords do not match');
            valid = false;
        } else {
            hideError(password);
            hideError(confirmPassword);
        }

        return valid;
    }

    function validateFile() {
        const fileInput = document.getElementById('profilePic');
        const filePath = fileInput.value;
        const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

        if (!allowedExtensions.exec(filePath)) {
            showError(fileInput, 'Please upload file having extensions .jpeg/.jpg/.png only.');
            fileInput.value = ''; // Clear the file
            return false;
        } else {
            hideError(fileInput);
            return true;
        }
    }

    function validateDOB() {
        const dobInput = document.getElementById('dob');
        const dob = new Date(dobInput.value);
        const age = calculateAge(dob);

        if (age < 18) {
            showError(dobInput, 'You must be at least 18 years old');
            return false;
        } else {
            hideError(dobInput);
            return true;
        }
    }

    function calculateAge(dob) {
        const difference = Date.now() - dob.getTime();
        const ageDate = new Date(difference); 
        return ageDate.getUTCFullYear() - 1970;
    }

    function showError(input, message) {
        const parent = input.parentElement;
        const errorSpan = parent.querySelector('.error-message');
        errorSpan.textContent = message;
        input.focus();
    }

    function hideError(input) {
        const parent = input.parentElement;
        const errorSpan = parent.querySelector('.error-message');
        errorSpan.textContent = '';
    }
};
