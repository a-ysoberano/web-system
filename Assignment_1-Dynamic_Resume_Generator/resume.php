    <?php 
    //Part 1
    $fullName = "Christian Arjay Y. Soberano";
    $email = "a.ysoberano@gmail.com";
    $address = "Tomana West, Rosales, Pangasinan";
    $phoneNumber = "09486119828";
    $parentsName = "Anabel Yabes";
    $parentsContact = "09232342328";
    $program = "BS Information Technology";

    //Part 2
    $careerTrack = "";

    if($program=="BS Information Technology"){
        $careerTrack = "Systems Administrator";
    }elseif($program=="BS Computer Science"){
        $careerTrack = "Software Developer";
    }else{
        $careerTrack = "Invalid";
    } 
    
    //Part 3
    $coreSkills = "";

    if($careerTrack == "Systems Administrator"){
        $coreSkills = "Linux OS, Apache Server Configuration, Hardware Troubleshooting";
    }elseif($careerTrack == "Software Developer"){
        $coreSkills = "PHP, MySQL, Conditional Logic, Object-Oriented Programming";
    }else{
        $coreSkills = "Invalid";
    }

    //Printing
    echo "<h1>".$fullName."</h1>";
    echo "<hr>";
    echo "<h2> Contact Details </h2>";
    echo "<p> Email: ".$email."</p>";
    echo "<p> Address: ".$address."</p>";
    echo "<p> Phone Number: ".$phoneNumber."</p>";
    echo "<p> Parents Name: ".$parentsName."</p>";      
    echo "<p> Parents Contact Number: ".$parentsContact."</p>";
    echo "<p> Program: ".$program."</p>";

    echo "<h2> Career Objective </h2>";
    echo "<p>To pursue a career as a " . $careerTrack . " and develop my skills in managing, maintaining, and improving computer systems and networks.</p>";

    echo "<h2>Technical Skills</h2>";
    echo "<p>".$coreSkills."</p>";
?>

