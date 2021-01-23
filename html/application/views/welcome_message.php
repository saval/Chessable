<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include('header.php'); ?>
    <div class="container">
        <p class="h1 pt-5">Welcome to Chessable coding challenge application!</p>

        <p class="pt-5">
            <p>
                There should be bank branches with locations and customers. Each customer should have a name and a balance. The functional requirements are as follows:
                <br>
                <ol>
                    <li>It should be possible to add new branches.</li>
                    <li>It should be possible to add new customers with a starting balance.</li>
                    <li>It should be possible to transfer a sum of money between any two customers.</li>
                    <li>It should be possible to run the following two reports:
                        <ul class="list-unstyled">
                            <li>a) Show all branches along with the highest balance at each branch. A branch with no customers should show 0 as the highest balance.</li>
                            <li>b) List just those branches that have more than two customers with a balance over 50,000.</li>
                        </ul>
                    </li>
                </ol>
            </p>
            <p class="h4 pt-5">
                So, let's start your journey from the menu in the header!
            </p>
        </div>
    </div>
<?php include('footer.php'); ?>
