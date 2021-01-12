<?php
    require_once "../app/views/users/bootstrap.php";
?>
<html>
<head></head>
<body>
    <div class="post">

                    <?php extract($this->_data); ?>
                    <?php foreach($home as $img) : ?>
                    <div class = "image">
                        <h6><?=$img['username']?></h6>
                        <img src=<?="../../public/img/picture/".$img['image_n']?>>
                        <button onclick="like('<?= $img['image_n']?>' , '<?=$img['image_id']?>');" class="like" type="button">
                            <div id = "<?=$img['image_n']?>"class="count">
                            <?php if (!$img['liked']):?>
                                <svg aria-label="Like" class="_8-yf5 " fill="#262626" height="24" viewBox="0 0 48 48" width="24"><path d="M34.6 6.1c5.7 0 10.4 5.2 10.4 11.5 0 6.8-5.9 11-11.5 16S25 41.3 24 41.9c-1.1-.7-4.7-4-9.5-8.3-5.7-5-11.5-9.2-11.5-16C3 11.3 7.7 6.1 13.4 6.1c4.2 0 6.5 2 8.1 4.3 1.9 2.6 2.2 3.9 2.5 3.9.3 0 .6-1.3 2.5-3.9 1.6-2.3 3.9-4.3 8.1-4.3m0-3c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5.6 0 1.1-.2 1.6-.5 1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z"></path></svg>
                            <?php else :?>
                                <svg aria-label="Unlike" class="_8-yf5 " fill="#ed4956" height="24" viewBox="0 0 48 48" width="24"><path d="M34.6 3.1c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5s1.1-.2 1.6-.5c1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z"></path></svg>
                                <?php endif; ?>
                            </div>
                        </button>
                        <button class="like " type="button"><div><svg aria-label="Comment" class="_8-yf5 " fill="#262626" height="24" viewBox="0 0 48 48" width="24"><path clip-rule="evenodd" d="M47.5 46.1l-2.8-11c1.8-3.3 2.8-7.1 2.8-11.1C47.5 11 37 .5 24 .5S.5 11 .5 24 11 47.5 24 47.5c4 0 7.8-1 11.1-2.8l11 2.8c.8.2 1.6-.6 1.4-1.4zm-3-22.1c0 4-1 7-2.6 10-.2.4-.3.9-.2 1.4l2.1 8.4-8.3-2.1c-.5-.1-1-.1-1.4.2-1.8 1-5.2 2.6-10 2.6-11.4 0-20.6-9.2-20.6-20.5S12.7 3.5 24 3.5 44.5 12.7 44.5 24z" fill-rule="evenodd"></path></svg></div></button>
                        <div class = "new_like" id = "<?= $img['image_id']?>" ><?= $img['like_count']?> Likes</div>
                        <?php
                                 $j = str_shuffle('abcdAacezd198');
                            ?>
                            <div class="" id="<?=$j?>">
                            <?php foreach($img['cmnt'] as $comment) :?>

                                <div class="fetchcmnt" >
                                    <?php if ($comment['image_n'] == $img['image_n']) :?>
                                    <h6 id ="h6"><?= $comment['username']?></h6>
                                    <span id = "span"><?= $comment['comment']?></span>
                                    <?php endif ;?>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <section class="okkk">
                        <?php
                            $i = str_shuffle('abcdAcd198');
                        ?>
                        <div>
                            <div class="cmnt">
                                <div class="ikk">
                                <textarea aria-label="Add a comment…" placeholder="Add a comment…" class="text" id = "<?=$i?>" autocomplete="off" autocorrect="off"></textarea>
                                <button onclick="cmnt('<?= $img['image_n']?>' ,'<?= $i?>' ,'<?= $j?>', '<?=$_SESSION['username']?>');" type="submit">Post</button>
                                </div>
                            </div>
                        </div>
                        </section>
                    </div>
                    <?php endforeach; ?>
                    <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if ($_GET['start'] != 0) :?>
                            <li class="page-item"><a class="page-link" href="/home/post?start=<?=$_GET['start'] - 1?>">Previous</a></li>
                        <?php else : ?>
                            <li class="page-item"><a class="page-link" href="/home/post?start=<?=0?>">Previous</a></li>
                        <?php endif;?>
                        <?php for($count = 0; $count < $img['countofimage'] ; $count++) :?>
                            <li class="page-item"><a class="page-link" href="/home/post?start=<?=$count?>"><?=$count?></a></li>
                        <?php endfor;?>
                        <?php if ($_GET['start'] < $img['countofimage'] - 1) :?>
                            <li class="page-item"><a class="page-link" href="/home/post?start=<?=$_GET['start'] + 1?>">Next</a></li>
                        <?php else : ?>
                            <li class="page-item"><a class="page-link" href="/home/post?start=<?=0?>">Next</a></li>
                        <?php endif;?>
                    </ul>
                    </nav>
                </div>
                <?php  require_once APP_PATH . DS . 'views' . DS .  'users' . DS . 'footer.php';  ?>
        <script type="text/javascript" src="/../public/js/main.js">
		</script>
</body>
</html>
<!-- <svg aria-label="Unlike" class="_8-yf5 " fill="#ed4956" height="24" viewBox="0 0 48 48" width="24"><path d="M34.6 3.1c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5s1.1-.2 1.6-.5c1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z"></path></svg> -->