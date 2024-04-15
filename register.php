<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <title>Registration Form</title>
    <style>
        .bg-custom {
            background-color: #23282d;
            color: white;
        }

        body {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-5">
                <h4 class="text-center mt-5">User Registration Form</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="registerSubmit" class="row g-3 needs-validation" novalidate method="POST">
                            <div class="mb-3 has-validation">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                                <div class="invalid-feedback">
                                    This field is required
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                                <div class="invalid-feedback">
                                    This field is invalid
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone:</label>
                                <input type="tel" id="phone" name="phone" class="form-control" required>
                                <div class="invalid-feedback">
                                    This field is invalid
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                                <div class="invalid-feedback">
                                    This field is required
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="confirm-password" class="form-label">Confirm Password:</label>
                                <input type="password" id="confirm-password" name="confirm-password"
                                    class="form-control" required>
                                <div class="invalid-feedback">
                                    Passwords do not match
                                </div>
                            </div>
                            <input type="text" value="register" name="type" hidden>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include "includes/footer.php";
    ?>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        // Get the form element
        var form = document.querySelector('.needs-validation');

        // Add event listener for form submission
        form.addEventListener('submit', function (event) {
            // Check if the form is valid
            if (!form.checkValidity()) {
                event.preventDefault(); // Prevent form submission if it's not valid
                event.stopPropagation(); // Stop event propagation
            }

            // Validate phone number field
            var phoneField = document.getElementById('phone');
            if (!/^\d+$/.test(phoneField.value)) {
                phoneField.classList.add('is-invalid'); // Add invalid class
                event.preventDefault(); // Prevent form submission
                event.stopPropagation(); // Stop event propagation
            }

            // Validate password and confirm password fields
            var passwordField = document.getElementById('password');
            var confirmPasswordField = document.getElementById('confirm-password');
            if (passwordField.value !== confirmPasswordField.value) {
                confirmPasswordField.setCustomValidity('Passwords do not match'); // Set custom validation message
                confirmPasswordField.classList.add('is-invalid'); // Add invalid class
                event.preventDefault(); // Prevent form submission
                event.stopPropagation(); // Stop event propagation
            }

            // Add the Bootstrap validation classes
            form.classList.add('was-validated');
        });

    </script>
</body>

</html>