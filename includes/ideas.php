<?php

require_once 'core/classes/postIdea.php';
$ideas = postIdea::getIdeas();

?>

<h3>アイデア</h3>
<div class="idea-container">
    <div class="row g-4 ">
        <?php foreach($ideas as $idea) {?>
        <div class="col-xxl-3 col-lg-4 col-md-6">
        <a href="<?php echo BASE_URL?>post/<?php echo $idea['id']?>">
            <div class="idea card-effect mx-4">
                <div class="card-img">
                    <img src="assets/images/posts/<?php echo $idea['imgPost']; ?>" alt="">
                </div>
                <div class="card-text">
                    <h6 class="card-text-title fw-bold pt-1"><?php echo $idea['title']; ?></h6>
                    <p class="card-text-body"><?php echo $idea['body']; ?></p>
                </div>
                
            </div>
        </a>
        </div>
        
        <?php }; ?>
    </div>
</div>