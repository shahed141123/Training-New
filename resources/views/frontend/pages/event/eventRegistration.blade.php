@extends('frontend.pages.event.app')

@section('event-content')
    <style>
        .hidden {
            display: none;
        }
    </style>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 px-0">
                    <div class="image-container image-container-reg">
                        <img src="{{ asset('frontend/images/event_registration.jpg') }}" alt="Event Image" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 registration-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pb-4">
                        <h1 class="text-center">Event Registration</h1>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-3">
                    <div class="card p-0 bg-light" style="border: 2px solid #eee;">
                        <div class="card-body">
                            <!-- First Form -->
                            <form id="form1" action="" method="post">
                                @csrf
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="name">Name:</label>
                                                <input class="form-control form-control-sm" type="text" id="name"
                                                    name="name" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="email">Email:</label>
                                                <input class="form-control form-control-sm" type="email" id="email"
                                                    name="email" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="phone">Phone Number:</label>
                                                <input class="form-control form-control-sm" type="number" id="phone"
                                                    name="phone" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="password">Password:</label>
                                                <input class="form-control form-control-sm" type="password" id="password"
                                                    name="password" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="confirm_password">Confirm Password:</label>
                                                <input class="form-control form-control-sm" type="password"
                                                    id="confirm_password" name="confirm_password" required>
                                            </div>
                                        </div>
                                        <div class="py-4">
                                            <div class="col-12">
                                                <input type="checkbox" id="check1" name="check1">
                                                <label for="check1">Some Check</label>
                                            </div>

                                            <div class="col-12">
                                                <input type="checkbox" id="terms" name="terms" required>
                                                <label for="terms">Accept Terms and Conditions</label>
                                            </div>

                                            <div class="col-12">
                                                <input type="checkbox" id="policy" name="policy" required>
                                                <label for="policy">Accept Privacy Policy</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div>
                                                <button type="submit"
                                                    class="btn btn-primary reg-btn w-100 mt-3 rounded-2 cst-font">Submit
                                                    Form</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <!-- Second Form -->
                            <form id="form2" class="hidden">
                                <div class="container">
                                    <div class="row">
                                        <!-- Project Name (Text Input) -->
                                        <div class="col-12">
                                            <label for="project_name" class="form-label">Project Name:</label>
                                            <input type="text" id="project_name" name="project_name" class="form-control"
                                                required>
                                        </div>

                                        <!-- Select Event (Select Input) -->
                                        <div class="col-12">
                                            <label for="event" class="form-label">Select Event:</label>
                                            <select id="event" name="event" class="form-select" required>
                                                <option value="" disabled selected>Select an event</option>
                                                <option value="event1">Event 1</option>
                                                <option value="event2">Event 2</option>
                                            </select>
                                        </div>

                                        <!-- Upload Project File (File Input) -->
                                        <div class="col-12">
                                            <label for="project_file" class="form-label">Upload Project File:</label>
                                            <input type="file" id="project_file" name="project_file"
                                                class="form-control" required>
                                        </div>

                                        <!-- Team Members (Number Input) -->
                                        <div class="col-12">
                                            <label for="team_members" class="form-label">Team Members:</label>
                                            <input type="number" id="team_members" name="team_members"
                                                class="form-control" required>
                                        </div>

                                        <!-- Project Website (Link Input) -->
                                        <div class="col-12">
                                            <label for="project_website" class="form-label">Project Website (if
                                                applicable):</label>
                                            <input type="url" id="project_website" name="project_website"
                                                class="form-control">
                                        </div>

                                        <!-- Technologies Used (Tags Input) -->
                                        <div class="col-12">
                                            <label for="technologies_used" class="form-label">Technologies Used:</label>
                                            <input type="text" id="technologies_used" name="technologies_used"
                                                class="form-control" placeholder="Enter technologies separated by commas">
                                        </div>

                                        <!-- Project Status (Select Input) -->
                                        <div class="col-12">
                                            <label for="project_status" class="form-label">Project Status:</label>
                                            <select id="project_status" name="project_status" class="form-select"
                                                required>
                                                <option value="" disabled selected>Select status</option>
                                                <option value="in_progress">In Progress</option>
                                                <option value="completed">Completed</option>
                                            </select>
                                        </div>

                                        <!-- Contact Email (Email Input) -->
                                        <div class="col-12">
                                            <label for="contact_email" class="form-label">Contact Email:</label>
                                            <input type="email" id="contact_email" name="contact_email"
                                                class="form-control" required>
                                        </div>

                                        <!-- Project Description (Textarea) -->
                                        <div class="col-12">
                                            <label for="project_description" class="form-label">Project
                                                Description:</label>
                                            <textarea id="project_description" name="project_description" class="form-control" rows="5" required></textarea>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-12 mt-3">
                                            <button type="submit" class="btn btn-primary">Submit Form 2</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById("form1").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent form submission for demo purpose

            // Retrieve form data
            const name = document.getElementById("name").value;
            const email = document.getElementById("email").value;
            const phone = document.getElementById("phone").value;
            const password = document.getElementById("password").value;
            const confirm_password = document.getElementById("confirm_password").value;
            const terms = document.getElementById("terms").checked;
            const policy = document.getElementById("policy").checked;

            // Log form data to console
            console.log('Form 1 Data:', { name, email, phone, password, confirm_password, terms, policy });

            // Switch to form 2
            document.getElementById("form1").classList.add("hidden");
            document.getElementById("form2").classList.remove("hidden");
        });

        window.onscroll = function() {
            var navbar = document.getElementById("navbar");
            if (window.pageYOffset >= 50) {
                navbar.classList.remove("navbar-dark");
                navbar.classList.add("navbar-light");
                navbar.classList.add("navbar-blur");
            } else {
                navbar.classList.remove("navbar-light");
                navbar.classList.remove("navbar-blur");
                navbar.classList.add("navbar-dark");
            }
        };
    </script>
@endsection
