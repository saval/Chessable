<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-xl">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?=site_url('/');?>">Chessable</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?=site_url('/');?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=site_url('/branches');?>">Branches</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=site_url('/customers');?>">Customers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=site_url('/reports');?>">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=site_url('/tests');?>">Tests</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="conatiner">
