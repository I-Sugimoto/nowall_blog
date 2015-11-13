-- データベースの作成(データベース名に注意)
create database nowall_blog;

-- 作業ユーザーの設定
grant all on nowall_blog.* to testuser@localhost identified by '9999';

-- 使用するデータベースの宣言
use nowall_blog;

-- テーブルの作成
create table posts (
    id int primary key auto_increment,
    title varchar(255),
    body text,
    created_at datetime,
    updated_at datetime
);


