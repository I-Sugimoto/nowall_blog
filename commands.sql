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

-- テストレコードを入れておく
insert into posts (body, title, created_at, updated_at) values
('株式会社NOWALL代表取締役社長: 柏木 祥太
プログラミングとの出会いは１２歳から。
父から譲り受けたWindows98のノートブックから独学で
Perl、PHP、Javaといったプログラミング言語を習得する。

2013年、スパルタキャンプ等といったイベントにて、プログラミング講師を務める。

2014年、当社創業。現在に至る。','代表紹介',now(), now()
);

insert into posts (body, title, created_at, updated_at) values
(
    '学校では学べないような、仕事や実務で本当に役に立つことを、ELITESでは学ぶことができます。
ELITESでは、ただ学ぶだけでなく、実際にそれを仕事として使えるようになるために、実務経験もカリキュラムの一部として取り入れております。
実際にクライアント企業様から開発案件を頂いている弊社であるからこそできることであり、他のサービスではできない経験を積むことが可能です。',
    '教育サービス「ELITES」もよろしく！',
    now(), now()
);

insert into posts (body, title, created_at, updated_at) values
(
    '<< ELITES CAMP大忘年会！！>>
ELITES CAMP大忘年会を12/20 20:30〜に開催致します。
参加費のお支払いは当日でも可能ですが
人数を把握しておきたいので迷っている方もなるべくエントリーをお願いいたします！是非皆さんご参加ください〜(^o^)',
    '今日はELITES CAMP忘年会！！！',
    now(), now()
);

-- select * from posts\G : postsテーブルの全てのレコードを表示(ただし、文末を\Gにすると、1つ1つのレコードを見やすくしてくれる)
