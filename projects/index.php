<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Projects grid</title>
    <meta name="description" content="All my highligted projects">
    <meta name="keywords" content="Applications, python, javascript, php, web development, computer science">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbit&family=Pixelify+Sans&family=Press+Start+2P&family=Rubik+Mono+One&family=Ubuntu+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/buttons.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body style="background-color: #161616">
<header>

    <nav>
        <div class="navbar">
            <div class="logo"><a href="../">AFM</a></div>


            <ul class="nav-list">
                <li class="nav-list-items"><a href="../">Home</a></li>
                <li class="nav-list-items"><a href="#">Resume</a></li>
                <li class="nav-list-items"><a href="../#contact">Contact</a></li>
            </ul>

            <div class="mobile-menu-button">
                <i class="fas fa-bars toggle-button"></i>
            </div>

        </div>
    </nav>
</header>
<div class="body-content" >
    <section class="body-elements">
        <h1 class="page-title" style="padding-top: 75px">Projects</h1>
    <div class="portfolio-grid">
        <?php
        // Replace 'yourFolderPath' with the actual path of your folder
        $folderPath = 'C:\xampp\htdocs\portfolio_website\projects\project_template';

        // Function to read filenames from a folder
        function readFilenames($folderPath) {
            return scandir($folderPath);
        }

        function filterFilenames($filenames) {
            $imageFiles = [];
            $htmlFiles = [];
            $txtFiles=[];

            foreach ($filenames as $filename) {

                // Exclude directories
                if (!is_dir($filename)) {
                    $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);

                    if ($extension === 'jpg' || $extension === 'jpeg' || $extension === 'png') {
                        // Image file
                        $imageFiles[] = $filenameWithoutExtension;
                    } elseif ($extension === 'html') {
                        // HTML file
                        $htmlFiles[] = $filenameWithoutExtension;
                    }elseif ($extension === 'txt') {
                        // HTML file
                        $txtFiles[] = $filenameWithoutExtension;
                    }
                }
            }

            return [
                'images' => $imageFiles,
                'html' => $htmlFiles,
                'txt' => $txtFiles
            ];
        }
        // Function to generate HTML <img> elements
        function generateDivElements($filename,$desc) {//array of strings

                echo
                    '<div class="portfolio-item"> 
                        
                        <a href="project_template/'.$filename.'.html">
                            <img src="./project_template/'.$filename.'.jpg" alt="'.$filename.'">                          
                                <div class="overlay">
                                    <h2 class="proj-name">'.$filename.'</h2>
                                    <p>'.$desc.'</p>
                                </div>

                         </a>
                    </div>';


        }

        function generateDescription($filename){
            $myfile = fopen("project_template/".$filename.".txt", "r") or die("Unable to open file!");
            return $myfile;
        }

        // Read filenames from the folder
        $allFilenames = readFilenames($folderPath);
        $filteredFiles = filterFilenames($allFilenames);//[image,html]\



        // Generate HTML <img> elements
        foreach ($filteredFiles['html'] as $filename) {

            if(file_exists("project_template/".$filename.".jpg") && file_exists("project_template/".$filename.".txt")) {
                $desc=generateDescription($filename);
                generateDivElements($filename, fgets($desc));
            }
        }
        // Output the generated HTML code

        ?>

    </div>
    </section>
</div>


<script src="../js/javascript.js"></script>
</body>
