<?php
$conn = mysqli_connect("localhost", "root", "", "laundry");
if (mysqli_connect_errno()) {
    printf("An error occured: %s", mysqli_connect_error());
}
