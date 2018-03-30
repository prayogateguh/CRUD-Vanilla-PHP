<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
    header("Location: http://localhost:880/twiter/"); // Redirecting To Login Page
}