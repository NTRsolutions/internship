
<div class="main-content news-page">
  <div class="col-lg-12">
    <div class="page-header">
      <h1>News</h1>
      <div class="members-search">
        <form>
          <input type="text" class="search" placeholder="Search Connections..." required>
          <input type="button" class="button" value="Search">
        </form>
      </div>
    </div>
  </div>
  <div class="members-directory">
    <div class="members-count col-lg-12"><a href="#">All News <span>1</span></a></div>
    <form class="form-inline members-directory-form">
      <div class="form-group">
        <label for="">ORDER BY: </label>
        <select class="form-control">
            <option value="active">Last Active</option>
            <option value="newest">Newest Registered</option>
            <option value="alphabetical">Alphabetical</option>
        </select>
      </div>
    </form>
  </div>
  <div class="col-lg-12 school-news recent-post-widget">
    <div class="postings-container">
      <?php foreach($news as $k=>$v){ $images=json_decode($v->news_images);?>
      <section class="postings"> <img src="http://dev.rightlink.io/am/assets/news_images/thumbs/<?php echo $images[0];?>">
        <div class="post-content"><p><a href="#" class="post-header"><?php echo $v->news_title;?></a> <a href="#" class="post-description"><?php echo substr(strip_tags($v->news_title),0,100);?>...</a></p>
        <a href="<?php base_url();?>news/newsdetails/<?php echo $v->news_id;?>">Read more..</a>
        </div>
      </section>
      <?php } ?>
      
      
    </div>
  </div>
</div>  
  
