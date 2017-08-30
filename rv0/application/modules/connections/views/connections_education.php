<link href="<?php echo ASSETS;?>assets/css/custom-styles.css" rel="stylesheet">
<script src="<?php echo ASSETS;?>assets/js/modernizr.js"></script>
<script src="<?php echo ASSETS;?>assets/js/main.js"></script>
<div class="main-content news-page">
    <div class="col-lg-12">
      <div class="page-header">
        <a href="#" class="profile-banner col-lg-12"><?php if(isset($connection->cover_image) && $connection->cover_image !=''){?><img src="<?php echo $connection->cover_image;?>"><?php }else{ ?><img src="<?php echo ASSETS;?>assets/img/emp-none.png"><?php } ?></a>
        
        <div class="profile-details">
          	<div class="profile-avatar"><a href="#"><?php if(isset($connection->profile_thumb_image) && $connection->profile_thumb_image !=''){?><img src="<?php echo $connection->profile_thumb_image;?>"><?php }else{ ?><img src="<?php echo ASSETS;?>assets/img/profile-big-thumb.jpg"><?php } ?></a></div>
            <div class="profile-content">
                <h2 class="profile-name">@<?php echo $connection->display_name;?></h2>
                <span class="profile-activity">active 1 month, 1 week ago</span>
                <p class="profile-update">Join the comunity of modern thinking students <a href="">View</a></p>
            </div>
        </div>
      </div>
    </div>
    <div class="members-directory">
      <div class="members-count col-lg-12">
        <ul class="profile-list">
          <li><a href="<?php echo base_url();?>connections/connectionactivity/<?php echo $connection->id;?>" >Activity</a></li>
          <li><a href="<?php echo base_url();?>connections/connectionprofile/<?php echo $connection->id;?>" class="active">Profile</a></li>
        </ul>
      </div>
      <div class="tabbing-container col-lg-12">
        <ul class="col-lg-4 nav nav-pills profile-tabbing">
          <li role="presentation" class="active"><a href="">View</a></li>
        </ul>
      </div>
    </div>
    <div class="col-lg-12">
		<section id="cd-timeline" class="cd-container">
		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<img src="img/cd-icon-picture.svg" alt="Picture">
			</div> <!-- cd-timeline-img -->

			<div class="cd-timeline-content">
				<h2>Title of section 1</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
				<a href="#0" class="cd-read-more">Read more</a>
				<span class="cd-date">Jan 14</span>
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-movie">
				<img src="img/cd-icon-movie.svg" alt="Movie">
			</div> <!-- cd-timeline-img -->

			<div class="cd-timeline-content">
				<h2>Title of section 2</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde?</p>
				<a href="#0" class="cd-read-more">Read more</a>
				<span class="cd-date">Jan 18</span>
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<img src="img/cd-icon-picture.svg" alt="Picture">
			</div> <!-- cd-timeline-img -->

			<div class="cd-timeline-content">
				<h2>Title of section 3</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, obcaecati, quisquam id molestias eaque asperiores voluptatibus cupiditate error assumenda delectus odit similique earum voluptatem doloremque dolorem ipsam quae rerum quis. Odit, itaque, deserunt corporis vero ipsum nisi eius odio natus ullam provident pariatur temporibus quia eos repellat consequuntur perferendis enim amet quae quasi repudiandae sed quod veniam dolore possimus rem voluptatum eveniet eligendi quis fugiat aliquam sunt similique aut adipisci.</p>
				<a href="#0" class="cd-read-more">Read more</a>
				<span class="cd-date">Jan 24</span>
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-location">
				<img src="img/cd-icon-location.svg" alt="Location">
			</div> <!-- cd-timeline-img -->

			<div class="cd-timeline-content">
				<h2>Title of section 4</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
				<a href="#0" class="cd-read-more">Read more</a>
				<span class="cd-date">Feb 14</span>
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-location">
				<img src="img/cd-icon-location.svg" alt="Location">
			</div> <!-- cd-timeline-img -->

			<div class="cd-timeline-content">
				<h2>Title of section 5</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum.</p>
				<a href="#0" class="cd-read-more">Read more</a>
				<span class="cd-date">Feb 18</span>
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-movie">
				<img src="img/cd-icon-movie.svg" alt="Movie">
			</div> <!-- cd-timeline-img -->

			<div class="cd-timeline-content">
				<h2>Final Section</h2>
				<p>This is the content of the last section</p>
				<span class="cd-date">Feb 26</span>
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->
	</section> <!-- cd-timeline -->

      <!--<div class="table-responsive">
        <h3>Profession</h3>
        <table class="table table-striped profession-table">
          <tbody>
            <tr>
              <td>Profession</td>
              <td><a href="#">select Indusry</a></td>
            </tr>
          </tbody>
        </table>
      </div>-->
    </div>
  </div>
  
