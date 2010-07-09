RSS mod for PunBB 1.2.x.

This enclosed rss.php file creates RSS feeds for PunBB 1.2.x categoires, forums, topics and recent posts.

=======================================================================

To create a RSS feed for a category, pass in the ID of the category:

	http://www.example.com/punbb/rss.php?cid=2

To create a RSS feed for a forum, pass in the ID of the forum:

	http://www.example.com/punbb/rss.php?fid=16

To create a RSS feed for a topic, pass in the ID of the topic:

	http://www.example.com/punbb/rss.php?tid=1254

To create a RSS feed for the last 15 posts, just access the rss.php page:

	http://www.example.com/punbb/rss.php


=======================================================================

To create links to these RSS feeds (as seen here: http://www.alexking.org/forums/), add the following code to the following files (using the PunBB 1.2.2 code):

RSS Feeds for Categories, edit index.php.

Find this code:

	<h2><span><?php echo pun_htmlspecialchars($cur_forum['cat_name']) ?></span></h2>

And change it to:

	<h2>
		<span><?php echo pun_htmlspecialchars($cur_forum['cat_name']) ?></span>
		<a href="rss.php?cid=<?php echo $cur_forum['cid'] ?>">RSS Feed</a>
	</h2>


RSS Feeds for Forums, edit index.php and viewforum.php.

In index.php, find this code:

	<div class="tclcon">
		<?php echo $forum_field."\n".$moderators ?>
	</div>

And change it to:

	<div class="tclcon">
		<?php echo $forum_field."\n".$moderators ?>
		<a href="rss.php?fid=<?php echo $cur_forum['fid'] ?>">RSS Feed</a>
	</div>

In viewforum.php, find this code:

	<h2><span><?php echo pun_htmlspecialchars($cur_forum['forum_name']) ?></span></h2>

And change it to:

	<h2>
		 <span><?php echo pun_htmlspecialchars($cur_forum['forum_name']) ?></span>
		 <a href="rss.php?fid=<?php echo $id ?>">RSS Feed</a>
	</h2>


RSS Feeds for Topics, edit index.php and viewforum.php.

In viewtopic.php, find this code:

	<div class="linkst">
		<div class="inbox">
			<p class="pagelink conl"><?php echo $paging_links ?></p>
			<p class="postlink conr"><?php echo $post_link ?></p>
			<ul><li><a href="index.php"><?php echo $lang_common['Index'] ?></a></li><li>&nbsp;&raquo;&nbsp;<a href="viewforum.php?id=<?php echo $cur_topic['forum_id'] ?>"><?php echo pun_htmlspecialchars($cur_topic['forum_name']) ?></a></li><li>&nbsp;&raquo;&nbsp;<?php echo pun_htmlspecialchars($cur_topic['subject']) ?></li></ul>
			<div class="clearer"></div>
		</div>
	</div>

And this code:

	<div class="postlinksb">
		<div class="inbox">
			<p class="postlink conr"><?php echo $post_link ?></p>
			<p class="pagelink conl"><?php echo $paging_links ?></p>
			<ul><li><a href="index.php"><?php echo $lang_common['Index'] ?></a></li><li>&nbsp;&raquo;&nbsp;<a href="viewforum.php?id=<?php echo $cur_topic['forum_id'] ?>"><?php echo pun_htmlspecialchars($cur_topic['forum_name']) ?></a></li><li>&nbsp;&raquo;&nbsp;<?php echo pun_htmlspecialchars($cur_topic['subject']) ?></li></ul>
			<?php echo $subscraction ?>
		</div>
	</div>

And change it to:

	<div class="linkst">
		<div class="inbox">
			<p class="pagelink conl"><?php echo $paging_links ?></p>
			<p class="postlink conr"><?php echo $post_link ?></p>
			<ul><li><a href="index.php"><?php echo $lang_common['Index'] ?></a></li><li>&nbsp;&raquo;&nbsp;<a href="viewforum.php?id=<?php echo $cur_topic['forum_id'] ?>"><?php echo pun_htmlspecialchars($cur_topic['forum_name']) ?></a></li><li>&nbsp;&raquo;&nbsp;<?php echo pun_htmlspecialchars($cur_topic['subject']) ?> (<a href="rss.php?tid=<?php echo $id ?>">RSS Feed</a>)</li></ul>
			<div class="clearer"></div>
		</div>
	</div>

And:

	<div class="postlinksb">
		<div class="inbox">
			<p class="postlink conr"><?php echo $post_link ?></p>
			<p class="pagelink conl"><?php echo $paging_links ?></p>
			<ul><li><a href="index.php"><?php echo $lang_common['Index'] ?></a></li><li>&nbsp;&raquo;&nbsp;<a href="viewforum.php?id=<?php echo $cur_topic['forum_id'] ?>"><?php echo pun_htmlspecialchars($cur_topic['forum_name']) ?></a></li><li>&nbsp;&raquo;&nbsp;<?php echo pun_htmlspecialchars($cur_topic['subject']) ?> (<a href="rss.php?tid=<?php echo $id ?>">RSS Feed</a>)</li></ul>
			<?php echo $subscraction ?>
		</div>
	</div>



=======================================================================

Notes:

- The RSS feeds exclude posts that are not publicly viewable.
- The RSS feeds include the "Category Name : Forum Name : Topic Name" as in the item title as appropriate.
- Please post any support questions on the PunBB forums:

http://forums.punbb.org/viewtopic.php?id=6586
