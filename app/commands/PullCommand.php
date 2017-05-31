<?php

use DiDom\Document;

/**
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2016/7/17
 * Time: 20:39
 */

function pushToMovesun($postData)
{
    $url = "http://movesun.com/admin/blog/edit";
}

class PullCommand extends \Illuminate\Console\Command{

    protected $name = 'blog:pull';

    protected $description = 'Command description.';

    private $blogId = 200167;

    private $blogApp = 'lvyahui';

    private $cnblogUrl = 'http://www.cnblogs.com';

    private $interfaces = array(
        'post_category_tags' => '/mvc/blog/CategoriesTags.aspx',
        'post_prev_next'     => '/post/prevnext',
        'blog_side_block'    => '/mvc/Blog/GetBlogSideBlocks.aspx',
        'post_comments'      => '/mvc/blog/GetComments.aspx',
        'post_view_count'    => '/mvc/blog/ViewCountCommentCout.aspx',
        'post_get_comments'  => '/mvc/blog/GetComments.aspx',
    );

    private $savedCategorys;

    private $savedTags ;
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->savedCategorys = Category::all()->keyBy('title')->all();
        $this->savedTags = Tag::all()->keyBy('name')->all();

        $listPage = $this->cnblogUrl . '/' . $this->blogApp . '/default.html';
        for($i = 5;$i > 0;$i--){
            echo "list:$listPage?page=$i\n";
            try{
                $doucument = new Document();
                $doucument->load(file_get_contents($listPage.'?page='.$i));
                $articleLinks = $doucument->find('.postTitle2');
                $articleLinks = array_reverse($articleLinks);
                echo 'post count:'.count($articleLinks)."\n";
                foreach ($articleLinks as $articleLink) {
                    if(strrpos($articleLink->text(),'[置顶]') !== false){
                        continue;
                    }
                    // 保存博客
                    $postUrl = $articleLink->attr('href');
                    echo "post:$postUrl\n";
                    $n = 3;
                    while($n-- && !$this->_saveBlog($postUrl));
                }
            }catch(Exception $e){
                echo "download $listPage?page=$i exception\n";
            }

        }
    }

    protected function _saveBlog($postUrl){
        $start = strrpos($postUrl, '/') + 1;
        $postId = intval(substr($postUrl, $start, strrpos($postUrl, '.html') - $start));

        if(Post::where('cnblogs_id',$postId)->first()){
            return;
        }
        $postData = array();

        $bindParams = http_build_query(array_merge(array(
            'postId'    =>  $postId
        ),array(
            'blogId'    =>  $this->blogId,
            'blogApp'   =>  $this->blogApp,
        )));

        $postData['cnblogs_url'] = $postUrl;
        $postData['cnblogs_id'] = $postId;

        try{
            $postDoc = new Document();
            $html = file_get_contents($postUrl);
            if(!$html) return false;
            $postDoc->load($html);
            $postData['title'] = $postDoc->first('.postTitle2')->text();

            $content = $postDoc->first('#cnblogs_post_body');
            $attr = $postDoc->first('.postDesc');

            $postData['content'] = $content->html();
            $postData['short'] = strip_tags(mb_substr($postData['content'],0,200));

            $postData['view_ct'] = intval(file_get_contents($this->cnblogUrl .$this->interfaces['post_view_count']
                . '?' . $bindParams));
            $postData['created_at'] = date('Y-m-d h:i:s',strtotime($attr->first('#post-date')->text()));

            /* 拉取分类 */
            $categoryTags = json_decode(file_get_contents($this->cnblogUrl . $this->interfaces['post_category_tags']
                .'?' .$bindParams ),true);

            if(preg_match_all('/>([\w\\\s\+\x{4e00}-\x{9fa5}]+)</u',$categoryTags['Categories'],$matches)){
                $categorys = $matches[1];
                $categorys[0] = trim($categorys[0]);
                // 只选第一个作为若尘博客的分类
                if(!isset($this->savedCategorys[$categorys[0]])){
                    echo "create category {$categorys[0]}\n";
                    $category = new Category();
                    $category->title = $categorys[0];
                    $category->save();
                    $this->savedCategorys[$category->title] = $category;
                }else{
                    $category = $this->savedCategorys[$categorys[0]];
                }
                $postData['category_id'] = $category->id;
            }
            $modelTags = array();
            if(preg_match_all('/>([\w\\\s\+\x{4e00}-\x{9fa5}]+)</u',$categoryTags['Tags'],$matches)){
                $tags = $matches[1];
                if(count($tags) > 0){
                    $modelTags = array();
                    foreach($tags as $tag){
                        $tag = trim($tag);
                        if(isset($this->savedTags[$tag])){
                            $modelTags[] = $this->savedTags[$tag];
                        }else{
                            echo "create tag {$tag}\n";
                            $modelTag = new Tag();
                            $modelTag->name = $tag;
                            $modelTag->save();
                            $this->savedTags[$tag] = $modelTag;
                            $modelTags[] = $modelTag;
                        }
                    }
                }
            }

            $posts [] = $postData;
            $post = Post::create($postData);
            if($modelTags){
                $post->tags()->saveMany($modelTags);
            }

            return true;
        }catch(Exception $e){
            echo "download $postUrl exception\n";
            return false;
        }

    }
    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
//            array('example', InputArgument::REQUIRED, 'An example argument.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
//            array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
    }
}





