<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masashi site</title>
    <!-- Link to external CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<di>
    <!-- Header Section -->
    <header class="main-header">
        <div class="header-container">
            <h1>Welcome to my porfolio</h1>
            <button class="toggle-btn" onclick="toggleNavbar()">☰ Menu</button>
            <!-- Navbar -->
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="about me.php">About Me</a></li>
                    <li><a href="projects.php">Projects</a></li>
                    <li><a href="skill.php">Skills</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin-left: auto;
            margin-right: auto;
            
        }
    
        input, textarea, select, button {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .project {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
        }
        .project img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }
        form {
        max-width: 500px;
        margin: 0 auto; /* Centers the form horizontally */
        padding: 20px;
        background-color: #fff; /* Optional: Adds a background for better visibility */
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional: Adds a shadow for a polished look */
        }

    </style>
</head>

    <h1>Projects</h1>
   
   
    <form id="project-form" enctype="multipart/form-data">
        <label for="title">Project Title:</label>
        <input type="text" id="title" name="title" placeholder="Enter project title" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" placeholder="Enter project description" required></textarea>

        <label for="skills">Associated Skills (comma-separated):</label>
        <input type="text" id="skills" name="skills" placeholder="e.g., JavaScript, PHP" required>

        <label for="image">Screenshot/Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <button type="submit">Add Project</button>
        <button id="reset-projects" style="background-color: red; color: white; margin-top: 20px;">
    Reset All Projects
</button>

    </form>

    <!-- Projects Display Section -->
    <div>
        <h2>Current Projects:</h2>
        <div id="projects-container"></div>
    </div>

    <!-- JavaScript -->
    <script>
        // Reference to the form and projects container
        const form = document.getElementById('project-form');
        const projectsContainer = document.getElementById('projects-container');

        // Function to display projects
        function displayProjects(projects) {
            projectsContainer.innerHTML = ''; // Clear current display
            projects.forEach((project, index) => {
                const projectDiv = document.createElement('div');
                projectDiv.className = 'project';

                const title = document.createElement('h3');
                title.textContent = project.title;

                const description = document.createElement('p');
                description.textContent = project.description;

                const skills = document.createElement('p');
                skills.textContent = `Skills: ${project.skills.join(', ')}`;

                const image = document.createElement('img');
                image.src = project.imageUrl;
                image.alt = `Screenshot of ${project.title}`;

                projectDiv.appendChild(title);
                projectDiv.appendChild(description);
                projectDiv.appendChild(skills);
                projectDiv.appendChild(image);

                projectsContainer.appendChild(projectDiv);
            });
        }

        // Function to save project to the server
        function saveProject(formData) {
            fetch('save_project.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Project saved:', data.project);
                    fetchProjects(); // Refresh the list of projects
                } else {
                    console.error('Error saving project:', data.message);
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error saving project:', error);
                alert("An error occurred while saving the project.");
            });
        }

        // Function to fetch projects from the server
        function fetchProjects() {
            fetch('fetch_projects.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayProjects(data.projects);
                } else {
                    console.error('Error fetching projects:', data.message);
                }
            })
            .catch(error => {
                console.error('Error fetching projects:', error);
            });
        }

        // Form submission handler
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent form submission

            const title = document.getElementById('title').value.trim();
            const description = document.getElementById('description').value.trim();
            const skills = document.getElementById('skills').value.split(',').map(skill => skill.trim());
            const image = document.getElementById('image').files[0];

            // Error handling
            if (!title || !description || !skills.length || !image) {
                alert("All fields are required.");
                return;
            }

            // Prepare form data for submission
            const formData = new FormData();
            formData.append('title', title);
            formData.append('description', description);
            formData.append('skills', JSON.stringify(skills));
            formData.append('image', image);

            // Save project to the server
            saveProject(formData);

            // Reset form after submission
            form.reset();
        });

        // Fetch initial projects on page load
        fetchProjects();
        // Reference to the reset button
const resetButton = document.getElementById('reset-projects');

// Reset projects handler
resetButton.addEventListener('click', function () {
    // Confirm reset action
    if (confirm('Are you sure you want to delete all projects? This action cannot be undone.')) {
        fetch('reset_projects.php', { method: 'POST' })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('All projects have been deleted.');
                    fetchProjects(); // Refresh the displayed projects
                } else {
                    alert('Failed to reset projects. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error resetting projects:', error);
                alert('An error occurred while resetting projects.');
            });
    }
});

    </script>
    <footer class="main-footer">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> My PHP Website. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
