CREATE TABLE `user` (
  `id`             INT(11)      NOT NULL AUTO_INCREMENT,
  `name`           VARCHAR(255)          DEFAULT NULL,
  `password`       VARCHAR(255)          DEFAULT NULL,
  `email`          VARCHAR(255) NOT NULL,
  `created_at`     DATETIME     NOT NULL,
  `updated_at`     DATETIME     NOT NULL,
  `last_login`     DATETIME     NOT NULL,
  `remember_token` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 17
  DEFAULT CHARSET = utf8 ;

CREATE TABLE purchase(
  id INT AUTO_INCREMENT PRIMARY KEY,
  pro_id INT NOT NULL COMMENT '产品ID',
  amount INT NOT NULL COMMENT '采购数量',
  craeted_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
  updated_at TIMESTAMP
);

CREATE TABLE storages (
  id INT AUTO_INCREMENT PRIMARY KEY ,
  od_item_id INT NOT NULL COMMENT '订单项ID',
  pro_id INT NOT NULL COMMENT '产品ID',
  purchase_id INT NOT NULL COMMENT '采购ID',
  amount INT NOT NULL COMMENT '数量',
  status ENUM('notin','in','lock','out') NOT NULL DEFAULT 'notin',
  created_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
  updated_at TIMESTAMP
)DEFAULT CHARACTER SET utf8;

ALTER TABLE customer_order_items ADD COLUMN pro_id INT NOT NULL COMMENT '产品ID';




ALTER TABLE purchase RENAME purchases;
ALTER TABLE purchases ADD COLUMN status ENUM('notin','in') NOT NULL DEFAULT 'notin';
SELECT * FROM vendor_products;
SELECT * FROM customers;


SELECT * FROM customer_orders;
SELECT * FROM customer_order_items;
SELECT * FROM purchases;
SELECT * FROM storages;

DELETE FROM customer_orders;
DELETE FROM customer_order_items;
DELETE FROM purchases;
DELETE FROM storages;

select * from `vendors` order by (
  select count(*) from purchases
  where purchases.pro_id in (
    select vendor_products.id from vendor_products
    where vendor_products.vendor_id = vendors.id
  )
) desc;

select * from `vendors` where (
  select count(*) from `purchases` inner join `vendor_products` on `vendor_products`.`id` = `purchases`.`pro_id` where `vendors`.`id` = `vendor_products`.`vendor_id`
) >= 1;

CREATE TABLE track_pirchase(
  id INT AUTO_INCREMENT PRIMARY KEY ,
  pirchase_id INT NOT NULL ,
  info VARCHAR(255) ,
  user_id INT NOT NULL ,
  created_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
  updated_at TIMESTAMP
);

ALTER TABLE track_pirchase RENAME track_purchase;
ALTER TABLE track_purchase CHANGE COLUMN pirchase_id purchase_id INT NOT NULL ;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `remember_token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE category(
  id INT AUTO_INCREMENT PRIMARY KEY ,
  title VARCHAR(32) NOT NULL ,
  level INT,
  weight INT NOT NULL DEFAULT 0 COMMENT '排序字段',
  parent_id INT NOT NULL,
  created_id TIMESTAMP NOT NULL DEFAULT current_timestamp,
  updated_id TIMESTAMP
) DEFAULT CHAR SET utf8;

CREATE TABLE post(
  id INT AUTO_INCREMENT PRIMARY KEY ,
  title VARCHAR(64) NOT NULL ,
  short VARCHAR(256) NOT NULL ,
  content TEXT NOT NULL ,
  created_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
  updated_at TIMESTAMP
) DEFAULT CHAR SET utf8;

ALTER TABLE rc_post ADD COLUMN category_id INT NOT NULL AFTER id;

DROP TABLE rc_tag;
CREATE TABLE tag(
  id INT AUTO_INCREMENT PRIMARY KEY ,
  name VARCHAR(16) NOT NULL
) DEFAULT CHAR SET utf8;

CREATE TABLE code(
  id INT AUTO_INCREMENT PRIMARY KEY ,
  body TEXT NOT NULL COMMENT '代码内容',
  short TEXT NOT NULL COMMENT '说明',
  created_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
  updated_at TIMESTAMP
) DEFAULT CHAR SET utf8;

DROP TABLE rc_code_tag;
CREATE TABLE code_tag(
  id INT AUTO_INCREMENT PRIMARY KEY ,
  tag_id INT NOT NULL ,
  code_id INT NOT NULL
) DEFAULT CHAR SET utf8;

ALTER TABLE rc_code ADD COLUMN title VARCHAR(64) NOT NULL COMMENT '标题' AFTER id;

UPDATE rc_code
SET title ='标题';

INSERT INTO rc_tag (name)
    VALUES
      ('Java'),
      ('C'),
      ('C++'),
      ('PHP'),
      ('`Python'),
      ('`Linux'),
      ('`SQL'),
      ('JavaScript');

INSERT INTO rc_code (body, short) VALUES
  ("$navMap = array(
        'site'  =>  array(
                'text'  =>  '首页',
                'url'   =>  URL::to('site/index'),
        ),
        'demo'  =>  array(
        ),
        'resume' =>  array(
                'text'  =>  '简历'
        ),
        'blog'  =>  array(
                'text'  =>  '博客',
                'url'   =>  URL::to('blog/list'),
        ),
        'project'=> array(
                'text'  =>  '项目',
        ),
        'code'  =>  array(
                'text'  =>  '微码'
        ),
        'test'  =>  array(

        ),
);
",'导航菜单配置'),
  ("class IndexController extends BaseController
{
    protected $layout = 'layouts.frame';
    public function getIndex(){
        $this->layout->nest('content','index.index',array());
    }
}",'控制器'),
  ("namespace admin;

class AdminController extends \BaseController
{
    protected $layout = 'layouts.main';
}
",'Admin控制器');


SELECT * FROM rc_code;
SELECT * FROM rc_tag;
ALTER TABLE rc_code ADD COLUMN title VARCHAR(64) NOT NULL COMMENT '标题' AFTER id;
UPDATE rc_code
SET title ='标题';

CREATE TABLE code_tag(
  id INT AUTO_INCREMENT PRIMARY KEY ,
  tag_id INT NOT NULL ,
  code_id INT NOT NULL
) DEFAULT CHAR SET utf8;
DROP TABLE rc_code_tag;
CREATE TABLE tag(
  id INT AUTO_INCREMENT PRIMARY KEY ,
  name VARCHAR(16) NOT NULL
) DEFAULT CHAR SET utf8;

CREATE TABLE code(
  id INT AUTO_INCREMENT PRIMARY KEY ,
  body TEXT NOT NULL COMMENT '代码内容',
  short TEXT NOT NULL COMMENT '说明',
  created_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
  updated_at TIMESTAMP
) DEFAULT CHAR SET utf8;

INSERT INTO rc_tag (name) VALUES ('JAVA'),('Android'),('Linux'),('HTML'),('PHP');

SELECT * FROM rc_tag;

INSERT INTO rc_code (body, lang, short) VALUES
  ('class Tag extends BaseModel
{
    protected $table = ''tag'';
    protected $timestamps = false;
}','php','基类'),
  ('.home{
  background: url("../images/top_bg.jpg") no-repeat fixed;
  background-size: cover ;
}
.page{
  -webkit-background-size:cover;
  background-size:cover;;
}','css','LESS Demo');
SELECT * FROM rc_code;

INSERT INTO rc_code_tag (tag_id, code_id) VALUES (5, 1),(4, 2);
ALTER TABLE rc_category CHANGE COLUMN parent_id parent_id INT NULL ;
INSERT INTO rc_category (title) VALUES ('C++'),('Java'),('PHP');

ALTER TABLE rc_code ADD COLUMN lang VARCHAR(12) NOT NULL DEFAULT 'Java' AFTER body;

ALTER TABLE rc_post ADD COLUMN view_ct INT NOT NULL DEFAULT 0 AFTER content;
ALTER TABLE rc_code ADD COLUMN view_ct INT NOT NULL DEFAULT 0 AFTER short;

INSERT INTO rc_post (title, short, content, category_id)
VALUES ('是大方的说法是发生的','水电费地方水电费水电费大杀四方','<p>水电费是电风扇的发斯蒂芬收到范德萨发水电费收到发多少f</p>',1),
  ('是电风扇的水电费但是','水电费水电费水电费收到收到发生的','<p>是电风扇的发生的水电费地方是</p>',1);

ALTER TABLE rc_category ADD COLUMN post_ct INT NOT NULL DEFAULT 0 AFTER parent_id;

UPDATE rc_category c SET c.post_ct = (SELECT count(*) FROM rc_post
WHERE rc_post.category_id = c.id);

INSERT rc_category (id, title) VALUES (1, 'C++');

CREATE TABLE comments (
  id INT AUTO_INCREMENT PRIMARY KEY ,
  proj_id INT NOT NULL ,
  proj_type ENUM('post','code') NOT NULL DEFAULT 'post',
  user_id INT,
  created_at TIMESTAMP NOT NULL DEFAULT current_timestamp,
  updated_at TIMESTAMP
) DEFAULT CHAR SET utf8;

ALTER TABLE rc_comments ADD COLUMN username VARCHAR(24)  COMMENT '用户名冗余列' AFTER user_id;

ALTER TABLE rc_comments ADD COLUMN content VARCHAR(256)  AFTER user_id;

ALTER TABLE rc_comments CHANGE COLUMN proj_type proj_type ENUM('post', 'code', 'site') NOT NULL DEFAULT 'post';


