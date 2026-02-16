<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Page</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/userr/dash/js/plugin/sweetalert/sweetalert.min.js"></script>
</head>

<body>
        @if(session('success'))
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                swal({
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    button: 'OK'
                });
            });
            </script>
        @endif
        @if($errors->any())
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                swal({
                    title: 'Error',
                    text: "{{ $errors->first() }}",
                    icon: 'error',
                    button: 'OK'
                });
            });
            </script>
        @endif
    <div class="container">
        <!-- Left Section -->
        <div class="left-section">
            <div class="features">
                <h2>Why Choose Plus500?</h2>
                <ul>
                    <li>Free and unlimited demo trading</li>
                    <li>Over 2800 leveraged instruments</li>
                    <li>Tight spreads & no commissions</li>
                    <li>Cutting-edge trading technology</li>
                    <li>Comprehensive Trading Academy</li>
                </ul>
            </div>
        </div>

        <!-- Right Section -->
        <div class="right-section">
            <div class="header">
               <a href="/"> <img src="logo.png" alt="Plus500 Logo" width="200px"></a>
                <h2>Join 26+ million who have chosen Plus500</h2>
            </div>
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <!-- Name Field -->
                <input type="text" placeholder="Enter Full Name" class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <!-- Email Field -->
                <input type="email" placeholder="Enter Email Address"
                    class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                    required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror


                <input type="number" placeholder="Enter Phone Number" class="form-control @error('phone') is-invalid @enderror"
                name="phone" value="{{ old('phone') }}" required>
            @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

                <div class="form-group">
                    <label for="documentType">Upload a government-issued document for registration.</label>
                    <select id="documentType" name="documentType" class="form-input" onchange="toggleOtherField()">
                        <option value="" disabled selected>Choose document type</option>
                        <option value="passport">Passport</option>
                        <option value="idCard">ID Card</option>
                        <option value="driverLicense">Driver's License</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <div class="form-group" id="otherField" style="display: none;">
                    <label for="otherDocument">Other Document Type</label>
                    <input type="text" id="otherDocument" name="otherDocument" placeholder="Specify document type" class="form-input">
                </div>
                
                <div class="form-group">
                    <label for="kycDocument">Upload Document</label>
                    <input type="file" id="kycDocument" name="kycDocument" class="form-input" required>
                </div>
                
              <style>
.password-wrapper {
  position: relative;
  width: 100%;
}

.password-wrapper input {
  width: 100%;
  padding-right: 45px; /* make space for icon */
}

.password-toggle {
  position: absolute;
  top: 50%;
  right: 14px;
  transform: translateY(-50%);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
}

.password-toggle svg {
  width: 22px;
  height: 22px;
  stroke: #6c757d;
  transition: stroke 0.3s ease;
}

.password-toggle:hover svg {
  stroke: #000;
}
</style>

<div class="form-group mb-3 password-wrapper">
  <input type="password" name="password" id="password"
    class="form-control @error('password') is-invalid @enderror"
    placeholder="Your Password" required>
  <span class="password-toggle" onclick="togglePassword('password', this)">
    <!-- Eye Icon (visible) -->
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
      <circle cx="12" cy="12" r="3" />
    </svg>
  </span>
  @error('password')
    <small class="text-danger">{{ $message }}</small>
  @enderror
</div>

<div class="form-group mb-3 password-wrapper">
  <input type="password" name="password_confirmation" id="password_confirmation"
    class="form-control" placeholder="Repeat Your Password" required>
  <span class="password-toggle" onclick="togglePassword('password_confirmation', this)">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
      <circle cx="12" cy="12" r="3" />
    </svg>
  </span>
</div>

<script>
function togglePassword(id, el) {
  const input = document.getElementById(id);
  const svg = el.querySelector('svg');

  if (input.type === "password") {
    input.type = "text";
    svg.innerHTML = `
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M3 3l18 18M9.88 9.88A3 3 0 0112 9c1.657 0 3 1.343 3 3 0 .795-.312 1.515-.82 2.05M6.2 6.2A9.956 9.956 0 002.458 12C3.732 16.057 7.523 19 12 19c1.64 0 3.192-.392 4.55-1.086M15.12 15.12L18.98 19" />
    `;
  } else {
    input.type = "password";
    svg.innerHTML = `
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
      <circle cx="12" cy="12" r="3" />
    `;
  }
}
</script>

                <!-- Submit Button -->
                <button type="submit" id="registerBtn">Create Account</button>
                <div id="registerLoading" style="display:none; margin:10px 0; color:#013b9e; font-weight:bold;">Processing...</div>

                <!-- Social Options -->
                <div class="other-options">
                    <p>or create an account with</p>
                    <div class="social-icons">
                        <img src="google.png" alt="Google" class="social-icon">
                        <img src="facebook.png" alt="Facebook" class="social-icon">
                        <img src="apple.png" alt="Apple" class="social-icon">
                    </div>
                </div>
                <a href="{{ route('login') }}" class="login-link">Already have an account?</a>
            </form>
        </div>
    </div>

    <script>
    function toggleOtherField() {
        const otherField = document.getElementById('otherField');
        const documentType = document.getElementById('documentType');
        if (documentType.value === 'other') {
            otherField.style.display = 'block';
        } else {
            otherField.style.display = 'none';
        }
    }

    $(function() {
        $('#registerBtn').click(function(e) {
            e.preventDefault();
            var form = $(this).closest('form')[0];
            var formData = new FormData(form);
            // Client-side validation
            var errors = [];
            if (!form.name.value.trim()) errors.push('Full Name is required.');
            if (!form.email.value.trim()) errors.push('Email is required.');
            if (!form.phone.value.trim()) errors.push('Phone Number is required.');
            if (!form.password.value.trim()) errors.push('Password is required.');
            if (form.password.value.length < 8) errors.push('Password must be at least 8 characters.');
            if (form.password.value !== form.password_confirmation.value) errors.push('Passwords do not match.');
            if (!form.documentType.value) errors.push('Document type is required.');
            var file = form.kycDocument.files[0];
            if (!file) errors.push('Document upload is required.');
            else {
                var allowed = ['application/pdf','image/jpeg','image/png','image/jpg'];
                if (allowed.indexOf(file.type) === -1) errors.push('Only PDF or image files allowed.');
                if (file.size > 20480 * 1024) errors.push('File must be less than 20MB.');
            }
            if (errors.length) {
                swal({title:'Error', text:errors[0], icon:'error', button:'OK'});
                return;
            }
            $('#registerBtn').prop('disabled', true);
            $('#registerLoading').show();
            $.ajax({
                url: form.action,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
                success: function(res) {
                    $('#registerBtn').prop('disabled', false);
                    $('#registerLoading').hide();
                    swal({title:'Success!', text:'Registration successful!', icon:'success', button:'OK'}).then(()=>{ window.location='{{ route('login') }}'; });
                },
                error: function(xhr) {
                    $('#registerBtn').prop('disabled', false);
                    $('#registerLoading').hide();
                    var msg = 'Registration failed.';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var firstKey = Object.keys(xhr.responseJSON.errors)[0];
                        msg = xhr.responseJSON.errors[firstKey][0];
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    swal({title:'Error', text:msg, icon:'error', button:'OK'});
                }
            });
        });
    });
    </script>
</body>

</html>
<style>

    /* General Styles */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    background-color: #f3f6fb;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.container {
    display: flex;
    max-width: 1200px;
    width: 100%;
    background-color: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

/* Left Section */
.left-section {
    flex: 1;
    background-color: #013b9e;
    color: white;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: left;
}

.features h2 {
    font-size: 24px;
    margin-bottom: 20px;
}

.features ul {
    list-style: none;
    padding: 0;
}

.features li {
    font-size: 18px;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
}

.features li::before {
    content: "✔";
    color: #00aaff;
    margin-right: 10px;
}

/* Right Section */
.right-section {
    flex: 1.2;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
}

.logo {
    font-size: 36px;
    font-weight: bold;
    color: #013b9e;
    margin-bottom: 10px;
}

form {
    max-width: 400px;
    margin: auto;
}

input, select {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 6px;
}

button {
    padding: 12px;
    width: 100%;
    background-color: #007bff;
    border: none;
    border-radius: 6px;
    color: white;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #005bb5;
}

.social-icons {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
}

.social-icon {
    width: 40px;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.social-icon:hover {
    transform: scale(1.1);
}

/* Responsive Styles */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
    }

    .left-section {
        padding: 20px;
        text-align: center;
    }

    .right-section {
        padding: 20px;
    }
}

@media (max-width: 480px) {
    input, button {
        padding: 10px;
    }

    .logo {
        font-size: 28px;
    }
}

.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
}

label {
    font-size: 14px;
    color: #555;
    margin-bottom: 5px;
    font-weight: 500;
}

.form-input {
    padding: 14px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 8px;
    transition: border-color 0.2s;
}

.form-input:focus {
    border-color: #013b9e;
    outline: none;
}


</style>