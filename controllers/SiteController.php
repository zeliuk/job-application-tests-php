<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Post;
use yii\data\Pagination;

class SiteController extends Controller{
    /**
     * {@inheritdoc}
     */
    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(){
        return $this->render('index');
    }
	
	/**
	 * Displays test 1.
	 *
	 * @return string
	 */
	public function actionTest1(){

        // Number of posts per page
        $pageSize = 9;

        // Get current page number from the request
        $page = Yii::$app->request->get('page', 1);

        // Fetch posts from the Post model including pagination
        $posts = Post::fetchAll($page, $pageSize);

        // Set up pagination
        $pagination = new Pagination([
            'totalCount' =>  $posts['totalCount'],
            'pageSize' => $pageSize,
            'page' => $page - 1, // Adjust for zero-based index
        ]);

        // Render the view with posts and pagination
        return $this->render('test1', [
            'posts' => $posts['data'],
            'pagination' => $pagination,
        ]);
	}
}