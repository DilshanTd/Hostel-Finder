<header>
    <div class="logo">
        Hostel Finder
    </div>
    <nav>
        <ul>
            <?php
            session_start();
            include_once ("modals/user.php");
            if ($_SESSION["user"]->type == "student") { ?>
                <li><a href="student_home.php">Home Page</a></li>
                <li><a href="student_reservations.php">Reservations</a></li>


            <?php } elseif ($_SESSION["user"]->type == "landlord") { ?>
                <li><a href="landlord_home.php">Home</a></li>
                <li><a href="add_listing.php">Add Listing</a></li>
                <li><a href="landlord_requests.php">Requests</a></li>

            <?php } elseif ($_SESSION["user"]->type == "warden") { ?>
                <li><a href="warden_home.php">Home - Warden</a></li>


            <?php } ?>
        </ul>
    </nav>
    <div class="logout">
        <a href="Logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</header>