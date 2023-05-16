<?php

require_once 'core/classes/postProb.php';
$ideas = postProb::getProbs();

?>

<h3>問題</h3>
<div class="idea-container">
    <div class="row g-4 ">
        <?php foreach($ideas as $idea) {?>
        <div class="col-xxl-3 col-lg-4 col-md-6">
        <a href="<?php echo BASE_URL?>prob/<?php echo $idea['id']?>">
            <div class="idea card-effect mx-4">
                <div class="card-img">
                    <img src="assets/images/probs/<?php echo $idea['imgPost']; ?>" alt="">
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