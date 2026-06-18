<div class="sidebar">

    <div class="sidebar-header">
        <h4>LearnHub</h4>
    </div>

    <ul class="sidebar-menu">

        <li>
            <a href="user_dashboard.php">
                🏠 Dashboard
            </a>
        </li>

        <li>
            <a href="languages.php">
                🌍 Languages
            </a>
        </li>

        <li>
            <a href="../user/lesson_list.php">
                📚 Lessons
            </a>
        </li>

        <li>
            <a href="../quizzes/assesment_quiz.php">
                📝 Quiz
            </a>
        </li>

        <li>
            <a href="leaderboard.php">
                🏆 Leaderboard
            </a>
        </li>

        <li>
            <a href="../uploads/profile.php">
                👤 Profile
            </a>
        </li>

        <li>
            <a href="../pages/logout.php">
                🚪 Logout
            </a>
        </li>

    </ul>

</div>
<style>
    /* Sidebar */

.sidebar{
    position:fixed;
    top:0;
    left:0;
    width:250px;
    height:100vh;
    background:#212529;
    color:white;
    padding-top:20px;
    z-index:1000;
}

.sidebar-header{
    text-align:center;
    padding:20px;
    border-bottom:1px solid rgba(255,255,255,0.1);
}

.sidebar-menu{
    list-style:none;
    padding:0;
    margin:0;
}

.sidebar-menu li{
    margin:5px 0;
}

.sidebar-menu li a{
    display:block;
    padding:15px 25px;
    color:white;
    text-decoration:none;
    transition:0.3s;
}

.sidebar-menu li a:hover{
    background:#0d6efd;
    padding-left:35px;
}

/* Main Content */

.main-content{
    margin-left:250px;
}
</style>