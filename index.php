<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodHub Server</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-5">
        <div class="row text-center">
            <h1>FoodHub Server</h1>
        </div>
        
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <nav>
                    <ul>
                        <li class="py-2">
                            <a href="/foodhub_server/analysis_report.php?request=getAll">
                                Analysis Report -> getAll
                            </a>
                        </li>
                        <li class="py-2">
                            <a href="/foodhub_server/category.php?request=getAll">
                                category -> getAll
                            </a>
                        </li>
                        <li class="py-2">
                            <a href="/foodhub_server/donation_form.php?request=getAll">
                                Donation Form -> getAll
                            </a>
                        </li>
                        <li class="py-2">
                            <a href="/foodhub_server/location_report.php?request=getAll">
                                Location Report -> getAll
                            </a>
                        </li>
                        <li class="py-2">
                            <a href="/foodhub_server/news.php?request=getAll">
                                News -> getAll
                            </a>
                        </li>
                        <li class="py-2">
                            <a href="/foodhub_server/request_form.php?request=getAll">
                                Request Form -> getAll
                            </a>
                        </li>
                        <li class="py-2">
                            <a href="/foodhub_server/state.php?request=getAll">
                                State -> getAll
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <form action="./category.php" method="POST">
            <input type="text" name="categoryID" >
            <input type="text" name="request" value="DeleteCategory">
            <input type="submit" value="submit">
        </form>
        
    </div>

</body>
</html>