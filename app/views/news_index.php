<h1>News</h1>
<p>
    This is our brand-new epic news section;
</p>
<button class="btn btn-default day" data-class="day">Day</button>
<button class="btn btn-default night" data-class="night">Night</button>

<?php

//var_dump($this->user);
//var_dump($data);

$pagination = $data['pagination'];


//var_dump(Session::isAuthorized());

?>

<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h1 class="page-header">
            Page Heading
            <small>Secondary Text</small>
        </h1>

        <!-- First Blog Post -->
        <h2>
            <a href="#">Blog Post Title</a>
        </h2>

        <p class="lead">
            by <a href="index.php">Start Bootstrap</a>
        </p>

        <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:00 PM</p>
        <hr>
        <img class="img-responsive" src="http://placehold.it/900x300" alt="">
        <hr>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus
            inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum
            officiis rerum.</p>
        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>
    </div>
    </div>

    <?php

    foreach ($data['news'] as $news) {

        echo '<h1>' . '<a href="/news/one_news?article_id=' . $news['id'] . '">' . $news['title'] . '</a>' . '</h1>';
        echo '<p>By ' . $this->user->fullName() . '</p>';
        echo '<p><span class="glyphicon glyphicon-time"></span> Posted on ' . $news['created'] . '</p><hr>';
        echo '<img src="' . WS_IMAGES . 'thumb/' . $news['thumb'] . '" class="news-image">';
        echo '<p>' . $news['body'] . '</p>';



    }

    ?>

    <nav>
        <ul class="pagination">
            <li>
                <?php
                if ($pagination->totalPages() > 1) {
                    if ($pagination->hasPrevPage()) {
                        echo '<a href="news?page=' .
                            $pagination->prevPage() .
                            '" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>';
                    }
                }
                ?>
            </li>
            <?php
            for ($i = 1; $pagination->totalPages() >= $i; $i++) {
                if ($i == $page) {
                    echo '<li class="active"><a href="news?page=' . $i . '">' . "$i</a></li>";
                } else {
                    echo '<li><a href="news?page=' . $i . '">' . "$i</a></li>";
                }
            }
            ?>
            <li>
                <?php
                if ($pagination->totalPages() > 1) {
                    if ($pagination->hasNextPage()) {
                        echo '<a href="news?page=' . $pagination->nextPage() . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>';
                    }
                }
                ?>
            </li>
        </ul>
    </nav>

