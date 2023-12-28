<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/Adashboard.css') }}">
    <title>Admin Dashboard</title>

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>


<body>

    <!-- Navigation Bar -->
    <header>
        <div class="user-container">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if($admin && $admin->image)
                        <img id="adminImage" src="{{ asset('storage/admin_images/' . $admin->image) }}" alt="Admin Image" style="max-width: 40px; max-height: 40px; border-radius: 50%;">
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">My profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <div class="dropdown-divider"></div>
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <div id="content-container">

        
            <h1>Admin Dashboard</h1>

            <!-- Add Officer Form Section -->
            <div>
                
                <button id="showAddFormBtn">Add Officer</button>

                <form id="addOfficerForm" method="post" action="{{ route('admin.addOfficer') }}" enctype="multipart/form-data" style="display:none;">
                    @csrf

                    <!-- Add your form fields here (name, username, email, password) -->
                    <label for="username">Username:</label>
                    <input type="text" name="username" value="{{ old('username') }}" required>

                    <label for="fname">First Name:</label>
                    <input type="text" name="fname" value="{{ old('fname') }}" required>

                    <label for="lname">Last Name:</label>
                    <input type="text" name="lname" value="{{ old('lname') }}" required>

                    <label for="password">Password:</label>
                    <input type="password" name="password" required>

                    <label for="email">Email:</label>
                    <input type="email" name="email" value="{{ old('email') }}" required>

                    <label for="image">Profile Image:</label>
                    <input type="file" name="image" accept="image/*">

                    <button type="submit">Add Officer</button>
                </form>
            </div>

            <div>
    <h2>List of Officers</h2>
    <ul>
        @forelse($officers as $officer)
            <li style="display: flex; align-items: center; margin-bottom: 10px;">
                @if($officer->image)
                    <img src="{{ asset('storage/images/' . $officer->image) }}" alt="Officer Image"
                        style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
                @endif

                <div style="flex: 1;">
                    <span>{{ $officer->fname }} {{ $officer->lname }} - {{ $officer->email }}</span>
                </div>
                
                <!-- Add delete button with an icon for each officer -->
                <form method="post" action="{{ route('admin.deleteOfficer', ['officer' => $officer->userID]) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this officer?')">
                        Delete
                    </button>
                </form>
            </li>
        @empty
            <li>No officers found</li>
        @endforelse
    </ul>
</div>





            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Logout Button for Admins -->
            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
            </div>

            <script src="script.js"></script>
            <script>
        document.addEventListener('DOMContentLoaded', function () {
            var showAddFormBtn = document.getElementById('showAddFormBtn');
            var addOfficerForm = document.getElementById('addOfficerForm');
            var adminImage = document.getElementById('adminImage');
            var profileDropdown = document.getElementById('profileDropdown');

            showAddFormBtn.addEventListener('click', function () {
                if (addOfficerForm.style.display === 'none' || addOfficerForm.style.display === '') {
                    addOfficerForm.style.display = 'block';
                } else {
                    addOfficerForm.style.display = 'none';
                }
            });

            adminImage.addEventListener('click', function () {
                profileDropdown.classList.toggle('show');
            });

            // Close the dropdown if the user clicks outside of it
            window.addEventListener('click', function (event) {
                if (!event.target.matches('#adminImage')) {
                    var dropdowns = document.getElementsByClassName('dropdown-content');
                    for (var i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if (openDropdown.classList.contains('show')) {
                            openDropdown.classList.remove('show');
                        }
                    }
                }
            });
        });
    </script>
  

    <!-- Bootstrap JS and Popper.js (add them before your closing </body> tag) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>