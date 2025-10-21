<?php

/** @var yii\web\View $this */

/* Yii2 pagination widget */
use yii\widgets\LinkPager;

$this->title = 'Test 1 — ooptimo';
?>
<div class="site-test1">
    <div class="body-content">
        <div class="row mt-5">
            <div class="col-md-12">
                <h2>Test 1 — Consume API</h2>
	            <p>The goal is to load data from an external API and display it on screen.</p>
		    <p>We will use the "Fake API" <a href="https://jsonplaceholder.typicode.com/" target="_blank">JSONPlaceholder</a> to load data.<br>Use this endpoint: <code>https://jsonplaceholder.typicode.com/posts</code>, and display a list on this same page with the data retrieved.</p>
	            
	            <h5>Help</h5>
	            <ul>
		            <li>We are using the Yii v2 MVC framework: <a href="https://www.yiiframework.com/doc/guide/2.0/en" target="_blank">Guide</a>.</li>
		            <li>The external API is JSONPlaceholder: <a href="https://jsonplaceholder.typicode.com/guide/" target="_blank">Guide</a>.</li>
		            <li>Relevant files are located in <code>/controllers</code>, <code>/models</code>, and <code>/views</code>.</li>
		            <li>For styles, you can edit the <code>/web/css/site.css</code> file directly.</li>
	            </ul>
            </div>
        </div>
    </div>

	<hr>
	
	<div class="posts-list mb-5">
		<div class="row mt-4">
			<h2 class="mb-4">Posts</h2>
		</div>
		
		<div class="row">
			<!-- Check if there was an error fetching posts -->
			<?php if ( isset($posts['error']) ): ?>
				<div class="col-md-12">
					<div class="alert alert-danger" role="alert">
						<!-- Display the error message -->
						<?php echo $posts['message']; ?>
					</div>
				</div>
			<?php else: ?>
				<!-- Loop and display each post -->
				<?php foreach ( $posts as $post ): ?>
					<div class="col-md-4 mb-4">
						<div class="card h-100">
							<div class="card-body">
								<!-- Escape output to prevent HTML injection -->
								<h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
								<p class="card-text"><?= htmlspecialchars($post['body']) ?></p>
							</div>	
							<div class="card-footer text-ooptimo">
								<small>By <strong>User <?= htmlspecialchars($post['userId']) ?></strong> · Post <strong>#<?= htmlspecialchars($post['id']) ?></strong></small>
							</div>
						</div>
					</div>
				<?php endforeach; ?>	
			<?php endif; ?>
		</div>

		<div class="row">
			<div class="col-md-12 align-center">
				<div class="pagination-wrapper align-center mt-4">
					<!-- Yii2 pagination widget, with Bootstrap 5 structure -->
					<?= \yii\bootstrap5\LinkPager::widget(['pagination' => $pagination]) ?>
				</div>
			</div>
		</div>
	</div>
</div>