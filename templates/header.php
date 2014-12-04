<!DOCTYPE html>

<html>

    <head>

        <link href="/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="/css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title><?= htmlspecialchars($title) ?> - MusicMates</title>
        <?php else: ?>
            <title>MusicMates</title>
        <?php endif ?>

        <script src="/js/jquery-1.11.1.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/scripts.js"></script>
   
    </head>

    <body>
    
        <?php if (logged_in()): ?>
            <nav class="navbar navbar-default navbar-static-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Expand Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/">MusicMates</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="search.php">Search</a></li>
                            <li><a href="create_group.php">Create Group</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?= htmlspecialchars(user_name()); ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="profile.php">Profile</a></li>
                                    <li><a href="logout.php">Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        <?php else: ?>
            <!-- User not logged in show plain navbar -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Expand Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/">
                            MusicMates
                        </a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="register.php">Register</a></li>
                            <li><a href="login.php">Log In</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        <?php endif; ?>

        <div class="container">

            <div id="top">
                
            </div>

            <div id="middle">
                
