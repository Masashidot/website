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
<body>
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
<main></main>
    <style>
        body {
            font-family: Arial, sans-serif;
            
        }
        
        
        input, select, button {
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
        .skills-category {
            margin-bottom: 20px;
        }
        h3 {
            margin-bottom: 5px;
        }
        ul {
            list-style-type: square;
            padding-left: 20px;
        }
        #reset-button {
            background-color: red;
            color: white;
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

    <h1>Skills</h1>

    <!-- Form for Adding Skills -->
    <form id="skills-form">
        <label for="category">Skill Category:</label>
        <select id="category" required>
            <option value="Programming Languages">Programming Languages</option>
            <option value="Tools">Tools</option>
            <option value="Soft Skills">Soft Skills</option>
        </select>

        <label for="skill">Skill:</label>
        <input type="text" id="skill" placeholder="Enter skill (e.g., Python, Communication)" required>

        <button type="submit">Add Skill</button>
    </form>

    <button id="reset-button">Reset Skills</button>

    <!-- Skills Display Section -->
    <div>
        <h2>Current Skills:</h2>
        <div id="skills-container"></div>
    </div>

    <!-- JavaScript -->
    <script>
        // Function to fetch and display skills from the server
        function fetchSkills() {
            fetch('fetch_skills.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displaySkills(data.skills);
                    } else {
                        console.error('Failed to fetch skills:', data.message);
                    }
                })
                .catch(error => console.error('Error fetching skills:', error));
        }

        // Function to display skills
        function displaySkills(skills) {
            const container = document.getElementById('skills-container');
            container.innerHTML = ''; // Clear current display

            for (const category in skills) {
                const categoryDiv = document.createElement('div');
                categoryDiv.className = 'skills-category';

                const categoryTitle = document.createElement('h3');
                categoryTitle.textContent = category;

                const skillList = document.createElement('ul');
                skills[category].forEach(skill => {
                    const listItem = document.createElement('li');
                    listItem.textContent = skill;
                    skillList.appendChild(listItem);
                });

                categoryDiv.appendChild(categoryTitle);
                categoryDiv.appendChild(skillList);
                container.appendChild(categoryDiv);
            }
        }

        // Handle form submission
        document.getElementById('skills-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const category = document.getElementById('category').value;
            const skill = document.getElementById('skill').value.trim();

            if (!skill) {
                alert('Please enter a skill.');
                return;
            }

            fetch('save_skill.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ category, skill })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        fetchSkills(); // Refresh the skills display
                        document.getElementById('skills-form').reset();
                    } else {
                        alert('Failed to save skill.');
                    }
                })
                .catch(error => console.error('Error saving skill:', error));
        });

        // Handle reset button click
        document.getElementById('reset-button').addEventListener('click', function () {
            if (confirm('Are you sure you want to reset all skills? This action cannot be undone.')) {
                fetch('reset_skills.php', { method: 'POST' })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            fetchSkills(); // Refresh the skills display
                        } else {
                            alert('Failed to reset skills.');
                        }
                    })
                    .catch(error => console.error('Error resetting skills:', error));
            }
        });

        // Fetch initial skills on page load
        fetchSkills();
    </script>
       <footer class="main-footer">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> My PHP Website. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
