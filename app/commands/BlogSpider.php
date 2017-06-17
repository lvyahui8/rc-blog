<?php
use DiDom\Document;

/**
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2017/6/17
 * Time: 10:31
 */
class BlogSpider  extends \Illuminate\Console\Command
{
    protected $name = 'blog_spider';

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

    private $lastCnblogsId ;
    public function fire()
    {
        $this->savedCategorys = Category::all()->keyBy('title')->all();
        $this->savedTags = Tag::all()->keyBy('name')->all();
        $this->lastCnblogsId =  intval(Post::max('cnblogs_id'));
        // 从第一页开始抓取
        // 如果博客id比存储的最大的cnblogs_id还要大，说明是新文章，需要爬取。一直爬到最后一页为止
        $listPage = $this->cnblogUrl . '/' . $this->blogApp . '/default.html';
        $stop = false;
        while(! $stop){
            $i = 1;
            $doc = new Document();
            $doc->load(file_get_contents($listPage .' ?page='.$i));
            $articleLinks = $doc->find('.postTitle2');
            if(count($articleLinks) == 0){
                break;
            }
            foreach($articleLinks as $articleLink){
                if(strrpos($articleLink->text(),'[置顶]') !== false){
                    continue;
                }

                $postUrl = $articleLink->attr('href');
                $n = 3;
                $ret = 0;
                while($n-- && !($ret = $this->_saveBlog($postUrl)));
                if($ret === -1){
                    // 不用继续爬取
                    $stop = true;
                    break;
                }
            }
        }
    }

    protected function _saveBlog($postUrl){
        $start = strrpos($postUrl, '/') + 1;
        $postId = intval(substr($postUrl, $start, strrpos($postUrl, '.html') - $start));

        if($postId <= $this->lastCnblogsId){
            // 不用继续抓取
            return -1;
        }

        if(Post::where('cnblogs_id',$postId)->first()){
            return 2;
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

            return 1;
        }catch(Exception $e){
            echo "download $postUrl exception\n";
            return 0;
        }

    }
}