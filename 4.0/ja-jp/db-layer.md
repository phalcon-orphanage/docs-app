---
layout: article
language: 'ja-jp'
version: '4.0'
---

<a name='overview'></a>

# データベース抽象化レイヤー

[Phalcon\Db](api/Phalcon_Db) is the component behind [Phalcon\Mvc\Model](api/Phalcon_Mvc_Model) that powers the model layer in the framework. これは、C言語で完全に書かれたデータベースシステムのための独立した高レベルの抽象化レイヤーで構成されています。

このコンポーネントは従来のモデルを使用するよりも、データベースを低レベルで操作することができます。

<a name='adapters'></a>

## データベースアダプター

このコンポーネントはアダプターを使用して、特定のデータベースシステムの詳細をカプセル化します。Phalconでは、PDO を使用してデータベースに接続します。次のデータベースエンジンがサポートされます。

| Class                                                                          | Description                                                                                                    |
| ------------------------------------------------------------------------------ | -------------------------------------------------------------------------------------------------------------- |
| [Phalcon\Db\Adapter\Pdo\Mysql](api/Phalcon_Db_Adapter_Pdo_Mysql)           | 世界で最も使用されているリレーショナルデータベース管理システム (RDBMS) です。サーバーで動作し、多数のユーザーがいくつかのデータベースにアクセスできます。                              |
| [Phalcon\Db\Adapter\Pdo\Postgresql](api/Phalcon_Db_Adapter_Pdo_Postgresql) | PostgreSQL は、強力なオープンソースのリレーショナルデータベースシステムです。 これは15年以上の積極的な開発と実績のあるアーキテクチャを備えており、信頼性、データの完全性、正確性について高い評価を得ています。 |
| [Phalcon\Db\Adapter\Pdo\Sqlite](api/Phalcon_Db_Adapter_Pdo_Sqlite)         | SQLiteは、自己完結型でサーバレスでゼロ設定のトランザクション型SQLデータベースエンジンを実装したソフトウェアライブラリです                                              |

<a name='adapters-factory'></a>

### Factory

<a name='factory'></a>

`adaper`オプションを使用してPDO Adapterクラスをロードします。例えば:

```php
<?php

use Phalcon\Db\Adapter\Pdo\Factory;

$options = [
    'host'     => 'localhost',
    'dbname'   => 'blog',
    'port'     => 3306,
    'username' => 'sigma',
    'password' => 'secret',
    'adapter'  => 'mysql',
];

$db = Factory::load($options);
```

<a name='adapters-custom'></a>

### Implementing your own adapters

The [Phalcon\Db\AdapterInterface](api/Phalcon_Db_AdapterInterface) interface must be implemented in order to create your own database adapters or extend the existing ones.

<a name='dialects'></a>

## データベースの方言

Phalcon は、各データベース エンジンの特定の詳細を方言でカプセル化します。それらはアダプターに共通の機能と SQL ジェネレーターを提供します。

| Class                                                                 | Description                  |
| --------------------------------------------------------------------- | ---------------------------- |
| [Phalcon\Db\Dialect\Mysql](api/Phalcon_Db_Dialect_Mysql)           | MySQL データベースシステム向けのSQL方言     |
| [Phalcon\Db\Dialect\Postgresql](api/Phalcon_Db_Dialect_Postgresql) | PostgreSQLデータベースシステム向けのSQL方言 |
| [Phalcon\Db\Dialect\Sqlite](api/Phalcon_Db_Dialect_Sqlite)         | SQLiteデータベースシステム向けのSQL方言     |

<a name='dialects-custom'></a>

### 独自の方言を実装します

The [Phalcon\Db\DialectInterface](api/Phalcon_Db_DialectInterface) interface must be implemented in order to create your own database dialects or extend the existing ones. You can also enhance your current dialect by adding more commands/methods that PHQL will understand.

For instance when using the MySQL adapter, you might want to allow PHQL to recognize the `MATCH ... AGAINST ...` syntax. We associate that syntax with `MATCH_AGAINST`

We instantiate the dialect. We add the custom function so that PHQL understands what to do when it finds it during the parsing process. In the example below, we register a new custom function called `MATCH_AGAINST`. After that all we have to do is add the customized dialect object to our connection.

```php
<?php

use Phalcon\Db\Dialect\MySQL as SqlDialect;
use Phalcon\Db\Adapter\Pdo\MySQL as Connection;

$dialect = new SqlDialect();

$dialect->registerCustomFunction(
    'MATCH_AGAINST',
    function($dialect, $expression) {
        $arguments = $expression['arguments'];
        return sprintf(
            " MATCH (%s) AGAINST (%)",
            $dialect->getSqlExpression($arguments[0]),
            $dialect->getSqlExpression($arguments[1])
         );
    }
);

$connection = new Connection(
    [
        "host"          => "localhost",
        "username"      => "root",
        "password"      => "",
        "dbname"        => "test",
        "dialectClass"  => $dialect
    ]
);
```

We can now use this new function in PHQL, which in turn will translate it to the proper SQL syntax:

```php
$phql = "
  SELECT *
  FROM   Posts
  WHERE  MATCH_AGAINST(title, :pattern:)";

$posts = $modelsManager->executeQuery($phql, ['pattern' => $pattern]);
```

<a name='connection'></a>

## データベースへの接続

To create a connection it's necessary instantiate the adapter class. It only requires an array with the connection parameters. The example below shows how to create a connection passing both required and optional parameters:

##### MySQL Required elements

```php
<?php

$config = [
    'host'     => '127.0.0.1',
    'username' => 'mike',
    'password' => 'sigma',
    'dbname'   => 'test_db',
];
```

##### MySQL Optional

```php
$config['persistent'] = false;
```

##### MySQL Create a connection

```php
$connection = new \Phalcon\Db\Adapter\Pdo\Mysql($config);
```

##### PostgreSQL Required elements

```php
<?php

$config = [
    'host'     => 'localhost',
    'username' => 'postgres',
    'password' => 'secret1',
    'dbname'   => 'template',
];
```

##### PostgreSQL Optional

```php
$config['schema'] = 'public';
```

##### PostgreSQL Create a connection

```php
$connection = new \Phalcon\Db\Adapter\Pdo\Postgresql($config);
```

##### SQLite Required elements

```php
<?php

$config = [
    'dbname' => '/path/to/database.db',
];
```

##### SQLite Create a connection

```php
$connection = new \Phalcon\Db\Adapter\Pdo\Sqlite($config);
```

<a name='options'></a>

## PDO の追加オプションを設定

`options`パラメータを渡すことで接続時にPDOオプションを設定できます:

```php
<?php

$connection = new \Phalcon\Db\Adapter\Pdo\Mysql(
    [
        'host'     => 'localhost',
        'username' => 'root',
        'password' => 'sigma',
        'dbname'   => 'test_db',
        'options'  => [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
            PDO::ATTR_CASE               => PDO::CASE_LOWER,
        ]
    ]
);
```

<a name='connection-factory'></a>

## Factoryを使用した接続

単純に`ini` ファイルを使ってあなたの `データベース`サービスをデータベースに設定/接続できます。

```ini
[database]
host = TEST_DB_MYSQL_HOST
username = TEST_DB_MYSQL_USER
password = TEST_DB_MYSQL_PASSWD
dbname = TEST_DB_MYSQL_NAME
port = TEST_DB_MYSQL_PORT
charset = TEST_DB_MYSQL_CHARSET
adapter = mysql
```

```php
<?php

use Phalcon\Config\Adapter\Ini;
use Phalcon\Di;
use Phalcon\Db\Adapter\Pdo\Factory;

$di = new Di();
$config = new Ini('config.ini');

$di->set('config', $config);

$di->set(
    'db', 
    function () {
        return Factory::load($this->config->database);
    }
);
```

上記は適切なデータベース インスタンスを返ます。また、アプリケーションのコードを1 行も変更することがなく、接続資格情報を変更したり、データベース アダプターを変更したりできる利点があります。

<a name='finding-rows'></a>

## 行の検索

[Phalcon\Db](api/Phalcon_Db) provides several methods to query rows from tables. The specific SQL syntax of the target database engine is required in this case:

```php
<?php

$sql = 'SELECT id, name FROM robots ORDER BY name';

// データベースシステムへSQLステートメントを送信
$result = $connection->query($sql);

// 各robotの名前を表示
while ($robot = $result->fetch()) {
   echo $robot['name'];
}

// 配列内のすべての行を取得する
$robots = $connection->fetchAll($sql);
foreach ($robots as $robot) {
   echo $robot['name'];
}

// 最初の行だけを取得する
$robot = $connection->fetchOne($sql);
```

By default these calls create arrays with both associative and numeric indexes. You can change this behavior by using `Phalcon\Db\Result::setFetchMode()`. This method receives a constant, defining which kind of index is required.

| 定数                         | Description               |
| -------------------------- | ------------------------- |
| `Phalcon\Db::FETCH_NUM`   | 数字インデックスのある配列を返す          |
| `Phalcon\Db::FETCH_ASSOC` | 関連インデックスのある配列を返す          |
| `Phalcon\Db::FETCH_BOTH`  | 関連インデックスと数字インデックスのある配列を返す |
| `Phalcon\Db::FETCH_OBJ`   | 配列ではなく、オブジェクトを返す。         |

```php
<?php

$sql = 'SELECT id, name FROM robots ORDER BY name';
$result = $connection->query($sql);

$result->setFetchMode(Phalcon\Db::FETCH_NUM);
while ($robot = $result->fetch()) {
   echo $robot[0];
}
```

The `Phalcon\Db::query()` returns an instance of [Phalcon\Db\Result\Pdo](api/Phalcon_Db_Result_Pdo). These objects encapsulate all the functionality related to the returned resultset i.e. traversing, seeking specific records, count etc.

```php
<?php

$sql = 'SELECT id, name FROM robots';
$result = $connection->query($sql);

// Traverse the resultset
while ($robot = $result->fetch()) {
   echo $robot['name'];
}

// Seek to the third row
$result->seek(2);
$robot = $result->fetch();

// Count the resultset
echo $result->numRows();
```

<a name='binding-parameters'></a>

## パラメーターのバインド

Bound parameters is also supported in [Phalcon\Db](api/Phalcon_Db). バインドされたパラメータを使用することで、パフォーマンスの影響は最小限に抑えられますが、コードがSQLインジェクション攻撃の対象になる可能性を排除するために、この方法を使用することをお勧めします。 文字列と位置指定のプレースホルダーの両方をサポートしています。 パラメータのバインドは、以下のように簡単に実施できます:

```php
<?php

// 数値プレースホルダーにバインド
$sql    = 'SELECT * FROM robots WHERE name = ? ORDER BY name';
$result = $connection->query(
    $sql,
    [
        'Wall-E',
    ]
);

// 名前つきプレースホルダーにバインド
$sql     = 'INSERT INTO `robots`(name`, year) VALUES (:name, :year)';
$success = $connection->query(
    $sql,
    [
        'name' => 'Astro Boy',
        'year' => 1952,
    ]
);
```

数値プレースホルダを使用する場合は、整数を1または2として定義する必要があります。 この場合、 '1'または '2'は文字列であり数字ではないため、プレースホルダを正常に置き換えることができません。 With any adapter data are automatically escaped using [PDO Quote](https://www.php.net/manual/en/pdo.quote.php).

This function takes into account the connection charset, so its recommended to define the correct charset in the connection parameters or in your database server configuration, as a wrong charset will produce undesired effects when storing or retrieving data.

また、`execute`や`query`メソッドに直接パラメータを渡すこともできます。この場合、バインドパラメータは直接 PDO に渡されます:

```php
<?php

// Binding with PDO placeholders
$sql    = 'SELECT * FROM robots WHERE name = ? ORDER BY name';
$result = $connection->query(
    $sql,
    [
        1 => 'Wall-E',
    ]
);
```

<a name='typed-placeholders'></a>

## 型指定されたプレース ホルダー

プレースホルダーは、SQL インジェクション攻撃を避けるためにパラメーターをバインドすることができます:

```php
<?php

$phql = "SELECT * FROM Store\Robots WHERE id > :id:";

$robots = $this->modelsManager->executeQuery($phql, ['id' => 100]);
```

しかし、いくつかのデータベースでは、バインドパラメータが特定のタイプのプレースホルダーを使用する時、追加のアクションが必要になります:

```php
<?php

use Phalcon\Db\Column;

// ...

$phql = "SELECT * FROM Store\Robots LIMIT :number:";
$robots = $this->modelsManager->executeQuery(
    $phql,
    ['number' => 10],
    Column::BIND_PARAM_INT
);
```

`executeQuery()` でバインドタイプを指定する代わりに、パラメーターで型指定されたプレース ホルダーを使用できます:

```php
<?php

$phql = "SELECT * FROM Store\Robots LIMIT {number:int}";
$robots = $this->modelsManager->executeQuery(
    $phql,
    ['number' => 10]
);

$phql = "SELECT * FROM Store\Robots WHERE name <> {name:str}";
$robots = $this->modelsManager->executeQuery(
    $phql,
    ['name' => $name]
);
```

タイプを指定する必要がない場合は、型を省略することもできます:

```php
<?php

$phql = "SELECT * FROM Store\Robots WHERE name <> {name}";
$robots = $this->modelsManager->executeQuery(
    $phql,
    ['name' => $name]
);
```

型指定されたプレースホルダーは非常に有用です。というのも、静的な配列をプレースホルダーとしてバインドできますが、その際に配列の各要素を単独で渡す必要はないからです:

```php
<?php

$phql = "SELECT * FROM Store\Robots WHERE id IN ({ids:array})";
$robots = $this->modelsManager->executeQuery(
    $phql,
    ['ids' => [1, 2, 3, 4]]
);
```

以下のタイプが使用できます：

| バインドタイプ   | バインドタイプ定数                    | 例                   |
| --------- | ---------------------------- | ------------------- |
| str       | `Column::BIND_PARAM_STR`     | `{name:str}`        |
| int       | `Column::BIND_PARAM_INT`     | `{number:int}`      |
| double    | `Column::BIND_PARAM_DECIMAL` | `{price:double}`    |
| bool      | `Column::BIND_PARAM_BOOL`    | `{enabled:bool}`    |
| blob      | `Column::BIND_PARAM_BLOB`    | `{image:blob}`      |
| null      | `Column::BIND_PARAM_NULL`    | `{exists:null}`     |
| array     | `Column::BIND_PARAM_STR`の配列  | `{codes:array}`     |
| array-str | `Column::BIND_PARAM_STR`の配列  | `{names:array-str}` |
| array-int | `Column::BIND_PARAM_INT`の配列  | `{flags:array-int}` |

<a name='cast-bound-parameter-values'></a>

## バインドされたパラメータのキャスト

デフォルトでは、バインドされたパラメーターは PHP ユーザーランドで指定されたバインド型にキャストされていません。このオプションで、PDO でそれらをバインドする前に、Phalconが値をキャストできます。 この問題が発生する一般的な状況は、`LIMIT`/`OFFSET` プレース ホルダーの文字列を渡す場合です:

```php
<?php

$number = '100';
$robots = $modelsManager->executeQuery(
    'SELECT * FROM Some\Robots LIMIT {number:int}',
    ['number' => $number]
);
```

これは、次の例外を発生します:

    Fatal error: Uncaught exception 'PDOException' with message 'SQLSTATE[42000]:
    Syntax error or access violation: 1064 You have an error in your SQL syntax;
    check the manual that corresponds to your MySQL server version for the right
    syntax to use near ''100'' at line 1' in /Users/scott/demo.php:78
    

こうなるのは、100が文字列変数だからです。最初にこの値を整数にキャストすることで簡単に修正可能です:

```php
<?php

$number = '100';
$robots = $modelsManager->executeQuery(
    'SELECT * FROM Some\Robots LIMIT {number:int}',
    ['number' => (int) $number]
);
```

ただしこのソリューションの開発者は、どのようにバインドされているパラメーターが渡されるのか、またそのタイプについての特別な注意を払う必要があります。 このタスクを簡単にし、予期しない例外を回避するために、このキャストを行うように Phalconに指示することができます:

```php
<?php

\Phalcon\Db::setup(['forceCasting' => true]);
```

バインドタイプによって次のアクションが実行されます:

| バインドタイプ                      | Action                           |
| ---------------------------- | -------------------------------- |
| Column::BIND_PARAM_STR     | 値をネイティブなPHP文字列にキャストします。          |
| Column::BIND_PARAM_INT     | 値をネイティブなPHP整数にキャストします。           |
| Column::BIND_PARAM_BOOL    | 値をネイティブなPHP論理型にキャストします。          |
| Column::BIND_PARAM_DECIMAL | 値をネイティブなPHP実数型(double) にキャストします。 |

<a name='cast-on-hydrate'></a>

## Hydrateでのキャスト

データベースシステムからの返り値はPDOによって常に文字列型で表現されます。その値が数字型や論理型であっても、文字列型です。 これは、いくつかのカラムの型が、そのサイズ制限により対応する PHP ネイティブ型で表現できないために発生します。 例えば、MySQL の `BIGINT` は、PHP の 32 ビット整数として表すことができない大きな整数を格納できます。 そのため、PDO とORM は、デフォルトで文字列としてすべての値を残す、安全策を実施します。

ORM が自動的にこれらの型へ対応する PHP ネイティブ型に安全にキャストするように設定できます。

```php
<?php

\Phalcon\Mvc\Model::setup(['castOnHydrate' => true]);
```

このようにして、厳密に演算子を使用したり、変数のタイプを推測させたりすることができます:

```php
<?php

$robot = Robots::findFirst();
if (11 === $robot->id) {
    echo $robot->name;
}
```

<a name='crud'></a>

## 行の挿入、更新、および削除

To insert, update or delete rows, you can use raw SQL or use the preset functions provided by the class:

```php
<?php

// Inserting data with a raw SQL statement
$sql     = 'INSERT INTO `robots`(`name`, `year`) VALUES ('Astro Boy', 1952)';
$success = $connection->execute($sql);

// With placeholders
$sql     = 'INSERT INTO `robots`(`name`, `year`) VALUES (?, ?)';
$success = $connection->execute(
    $sql,
    [
        'Astro Boy',
        1952,
    ]
);

// Generating dynamically the necessary SQL
$success = $connection->insert(
    'robots',
    [
        'Astro Boy',
        1952,
    ],
    [
        'name',
        'year',
    ],
);

// Generating dynamically the necessary SQL (another syntax)
$success = $connection->insertAsDict(
    'robots',
    [
        'name' => 'Astro Boy',
        'year' => 1952,
    ]
);

// Updating data with a raw SQL statement
$sql     = 'UPDATE `robots` SET `name` = 'Astro boy' WHERE `id` = 101';
$success = $connection->execute($sql);

// With placeholders
$sql     = 'UPDATE `robots` SET `name` = ? WHERE `id` = ?';
$success = $connection->execute(
    $sql,
    [
        'Astro Boy',
        101,
    ]
);

// Generating dynamically the necessary SQL
$success = $connection->update(
    'robots',
    [
        'name',
    ],
    [
        'New Astro Boy',
    ],
    'id = 101' // Warning! In this case values are not escaped
);

// Generating dynamically the necessary SQL (another syntax)
$success = $connection->updateAsDict(
    'robots',
    [
        'name' => 'New Astro Boy',
    ],
    'id = 101' // Warning! In this case values are not escaped
);

// With escaping conditions
$success = $connection->update(
    'robots',
    [
        'name',
    ],
    [
        'New Astro Boy',
    ],
    [
        'conditions' => 'id = ?',
        'bind'       => [101],
        'bindTypes'  => [PDO::PARAM_INT], // Optional parameter
    ]
);
$success = $connection->updateAsDict(
    'robots',
    [
        'name' => 'New Astro Boy',
    ],
    [
        'conditions' => 'id = ?',
        'bind'       => [101],
        'bindTypes'  => [PDO::PARAM_INT], // Optional parameter
    ]
);

// Deleting data with a raw SQL statement
$sql     = 'DELETE `robots` WHERE `id` = 101';
$success = $connection->execute($sql);

// With placeholders
$sql     = 'DELETE `robots` WHERE `id` = ?';
$success = $connection->execute($sql, [101]);

// Generating dynamically the necessary SQL
$success = $connection->delete(
    'robots',
    'id = ?',
    [
        101,
    ]
);
```

<a name='transactions'></a>

## Transactions and Nested Transactions

Working with transactions is supported as it is with PDO. Perform data manipulation inside transactions often increase the performance on most database systems:

```php
<?php

try {
    // Start a transaction
    $connection->begin();

    // Execute some SQL statements
    $connection->execute('DELETE `robots` WHERE `id` = 101');
    $connection->execute('DELETE `robots` WHERE `id` = 102');
    $connection->execute('DELETE `robots` WHERE `id` = 103');

    // Commit if everything goes well
    $connection->commit();
} catch (Exception $e) {
    // An exception has occurred rollback the transaction
    $connection->rollback();
}
```

In addition to standard transactions, [Phalcon\Db](api/Phalcon_Db) provides built-in support for [nested transactions](https://en.wikipedia.org/wiki/Nested_transaction) (if the database system used supports them). When you call begin() for a second time a nested transaction is created:

```php
<?php

try {
    // Start a transaction
    $connection->begin();

    // Execute some SQL statements
    $connection->execute('DELETE `robots` WHERE `id` = 101');

    try {
        // Start a nested transaction
        $connection->begin();

        // Execute these SQL statements into the nested transaction
        $connection->execute('DELETE `robots` WHERE `id` = 102');
        $connection->execute('DELETE `robots` WHERE `id` = 103');

        // Create a save point
        $connection->commit();
    } catch (Exception $e) {
        // An error has occurred, release the nested transaction
        $connection->rollback();
    }

    // Continue, executing more SQL statements
    $connection->execute('DELETE `robots` WHERE `id` = 104');

    // Commit if everything goes well
    $connection->commit();
} catch (Exception $e) {
    // An exception has occurred rollback the transaction
    $connection->rollback();
}
```

<a name='events'></a>

## Database Events

[Phalcon\Db](api/Phalcon_Db) is able to send events to a [EventsManager](/4.0/en/events) if it's present. Some events when returning boolean false could stop the active operation. The following events are supported:

| Event Name            | Triggered                                            | Can stop operation? |
| --------------------- | ---------------------------------------------------- |:-------------------:|
| `afterConnect`        | After a successfully connection to a database system |         No          |
| `beforeQuery`         | Before send a SQL statement to the database system   |         Yes         |
| `afterQuery`          | After send a SQL statement to database system        |         No          |
| `beforeDisconnect`    | Before close a temporal database connection          |         No          |
| `beginTransaction`    | Before a transaction is going to be started          |         No          |
| `rollbackTransaction` | Before a transaction is rollbacked                   |         No          |
| `commitTransaction`   | Before a transaction is committed                    |         No          |

Bind an EventsManager to a connection is simple, [Phalcon\Db](api/Phalcon_Db) will trigger the events with the type `db`:

```php
<?php

use Phalcon\Events\Manager as EventsManager;
use Phalcon\Db\Adapter\Pdo\Mysql as Connection;

$eventsManager = new EventsManager();

// Listen all the database events
$eventsManager->attach('db', $dbListener);

$connection = new Connection(
    [
        'host'     => 'localhost',
        'username' => 'root',
        'password' => 'secret',
        'dbname'   => 'invo',
    ]
);

// Assign the eventsManager to the db adapter instance
$connection->setEventsManager($eventsManager);
```

Stop SQL operations are very useful if for example you want to implement some last-resource SQL injector checker:

```php
<?php

use Phalcon\Events\Event;

$eventsManager->attach(
    'db:beforeQuery',
    function (Event $event, $connection) {
        $sql = $connection->getSQLStatement();

        // Check for malicious words in SQL statements
        if (preg_match('/DROP|ALTER/i', $sql)) {
            // DROP/ALTER operations aren't allowed in the application,
            // this must be a SQL injection!
            return false;
        }

        // It's OK
        return true;
    }
);
```

<a name='profiling'></a>

## Profiling SQL Statements

[Phalcon\Db](api/Phalcon_Db) includes a profiling component called [Phalcon\Db\Profiler](api/Phalcon_Db_Profiler), that is used to analyze the performance of database operations so as to diagnose performance problems and discover bottlenecks.

Database profiling is really easy With [Phalcon\Db\Profiler](api/Phalcon_Db_Profiler):

```php
<?php

use Phalcon\Events\Event;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Db\Profiler as DbProfiler;

$eventsManager = new EventsManager();

$profiler = new DbProfiler();

// Listen all the database events
$eventsManager->attach(
    'db',
    function (Event $event, $connection) use ($profiler) {
        if ($event->getType() === 'beforeQuery') {
            $sql = $connection->getSQLStatement();

            // Start a profile with the active connection
            $profiler->startProfile($sql);
        }

        if ($event->getType() === 'afterQuery') {
            // Stop the active profile
            $profiler->stopProfile();
        }
    }
);

// Assign the events manager to the connection
$connection->setEventsManager($eventsManager);

$sql = 'SELECT buyer_name, quantity, product_name '
     . 'FROM buyers '
     . 'LEFT JOIN products ON buyers.pid = products.id';

// Execute a SQL statement
$connection->query($sql);

// Get the last profile in the profiler
$profile = $profiler->getLastProfile();

echo 'SQL Statement: ', $profile->getSQLStatement(), "\n";
echo 'Start Time: ', $profile->getInitialTime(), "\n";
echo 'Final Time: ', $profile->getFinalTime(), "\n";
echo 'Total Elapsed Time: ', $profile->getTotalElapsedSeconds(), "\n";
```

You can also create your own profile class based on [Phalcon\Db\Profiler](api/Phalcon_Db_Profiler) to record real time statistics of the statements sent to the database system:

```php
<?php

use Phalcon\Events\Manager as EventsManager;
use Phalcon\Db\Profiler as Profiler;
use Phalcon\Db\Profiler\Item as Item;

class DbProfiler extends Profiler
{
    /**
     * Executed before the SQL statement will sent to the db server
     */
    public function beforeStartProfile(Item $profile)
    {
        echo $profile->getSQLStatement();
    }

    /**
     * Executed after the SQL statement was sent to the db server
     */
    public function afterEndProfile(Item $profile)
    {
        echo $profile->getTotalElapsedSeconds();
    }
}

// Create an Events Manager
$eventsManager = new EventsManager();

// Create a listener
$dbProfiler = new DbProfiler();

// Attach the listener listening for all database events
$eventsManager->attach('db', $dbProfiler);
```

<a name='logging-statements'></a>

## Logging SQL Statements

Using high-level abstraction components such as [Phalcon\Db](api/Phalcon_Db) to access a database, it is difficult to understand which statements are sent to the database system. [Phalcon\Logger](api/Phalcon_Logger) interacts with [Phalcon\Db](api/Phalcon_Db), providing logging capabilities on the database abstraction layer.

```php
<?php

use Phalcon\Logger;
use Phalcon\Events\Event;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Logger\Adapter\File as FileLogger;

$eventsManager = new EventsManager();

$logger = new FileLogger('app/logs/db.log');

$eventsManager->attach(
    'db:beforeQuery',
    function (Event $event, $connection) use ($logger) {
        $sql = $connection->getSQLStatement();

        $logger->log($sql, Logger::INFO);
    }
);

// Assign the eventsManager to the db adapter instance
$connection->setEventsManager($eventsManager);

// Execute some SQL statement
$connection->insert(
    'products',
    [
        'Hot pepper',
        3.50,
    ],
    [
        'name',
        'price',
    ]
);
```

As above, the file `app/logs/db.log` will contain something like this:

```bash
[Sun, 29 Apr 12 22:35:26 -0500][DEBUG][Resource Id #77] INSERT INTO products
(name, price) VALUES ('Hot pepper', 3.50)
```

<a name='logger-custom'></a>

## Implementing your own Logger

You can implement your own logger class for database queries, by creating a class that implements a single method called `log`. The method needs to accept a string as the first argument. You can then pass your logging object to `Phalcon\Db::setLogger()`, and from then on any SQL statement executed will call that method to log the results.

<a name='describing-tables'></a>

## Describing Tables/Views

[Phalcon\Db](api/Phalcon_Db) also provides methods to retrieve detailed information about tables and views:

```php
<?php

// Get tables on the test_db database
$tables = $connection->listTables('test_db');

// Is there a table 'robots' in the database?
$exists = $connection->tableExists('robots');

// Get name, data types and special features of 'robots' fields
$fields = $connection->describeColumns('robots');
foreach ($fields as $field) {
    echo 'Column Type: ', $field['Type'];
}

// Get indexes on the 'robots' table
$indexes = $connection->describeIndexes('robots');
foreach ($indexes as $index) {
    print_r(
        $index->getColumns()
    );
}

// Get foreign keys on the 'robots' table
$references = $connection->describeReferences('robots');
foreach ($references as $reference) {
    // Print referenced columns
    print_r(
        $reference->getReferencedColumns()
    );
}
```

テーブルの説明は MySQLの `DESCRIBE`コマンドとほとんど同じで、次の情報が含まれています。

| Field        | Type        | Key                                                | Null                               |
| ------------ | ----------- | -------------------------------------------------- | ---------------------------------- |
| Field's name | Column Type | Is the column part of the primary key or an index? | Does the column allow null values? |

Methods to get information about views are also implemented for every supported database system:

```php
<?php

// Get views on the test_db database
$tables = $connection->listViews('test_db');

// Is there a view 'robots' in the database?
$exists = $connection->viewExists('robots');
```

<a name='tables'></a>

## Creating/Altering/Dropping Tables

(MySQL、Postgresql など) データベースシステム は、`CREATE`、`ALTER` または `DROP` などのコマンドを使ってテーブルを作成、変更、削除する機能を提供します。 The SQL syntax differs based on which database system is used. `Phalcon\Db` offers a unified interface to alter tables, without the need to differentiate the SQL syntax based on the target storage system.

<a name='tables-create'></a>

### Creating Tables

The following example shows how to create a table:

```php
<?php

use \Phalcon\Db\Column as Column;

$connection->createTable(
    'robots',
    null,
    [
       'columns' => [
            new Column(
                'id',
                [
                    'type'          => Column::TYPE_INTEGER,
                    'size'          => 10,
                    'notNull'       => true,
                    'autoIncrement' => true,
                    'primary'       => true,
                ]
            ),
            new Column(
                'name',
                [
                    'type'    => Column::TYPE_VARCHAR,
                    'size'    => 70,
                    'notNull' => true,
                ]
            ),
            new Column(
                'year',
                [
                    'type'    => Column::TYPE_INTEGER,
                    'size'    => 11,
                    'notNull' => true,
                ]
            ),
        ]
    ]
);
```

`Phalcon\Db::createTable()` accepts an associative array describing the table. Columns are defined with the class [Phalcon\Db\Column](api/Phalcon_Db_Column). The table below shows the options available to define a column:

| オプション           | Description                                                                                                                                | Optional |
| --------------- | ------------------------------------------------------------------------------------------------------------------------------------------ |:--------:|
| `type`          | Column type. Must be a [Phalcon\Db\Column](api/Phalcon_Db_Column) constant (see below for a list)                                        |    No    |
| `primary`       | True if the column is part of the table's primary key                                                                                      |   Yes    |
| `size`          | Some type of columns like `VARCHAR` or `INTEGER` may have a specific size                                                                  |   Yes    |
| `scale`         | `DECIMAL` or `NUMBER` columns may be have a scale to specify how many decimals should be stored                                            |   Yes    |
| `unsigned`      | `INTEGER` columns may be signed or unsigned. This option does not apply to other types of columns                                          |   Yes    |
| `notNull`       | Column can store null values?                                                                                                              |   Yes    |
| `default`       | Default value (when used with `'notNull' => true`).                                                                                     |   Yes    |
| `autoIncrement` | With this attribute column will filled automatically with an auto-increment integer. Only one column in the table can have this attribute. |   Yes    |
| `bind`          | One of the `BIND_TYPE_*` constants telling how the column must be bound before save it                                                     |   Yes    |
| `first`         | Column must be placed at first position in the column order                                                                                |   Yes    |
| `after`         | Column must be placed after indicated column                                                                                               |   Yes    |

[Phalcon\Db](api/Phalcon_Db) supports the following database column types:

* `Phalcon\Db\Column::TYPE_INTEGER`
* `Phalcon\Db\Column::TYPE_DATE`
* `Phalcon\Db\Column::TYPE_VARCHAR`
* `Phalcon\Db\Column::TYPE_DECIMAL`
* `Phalcon\Db\Column::TYPE_DATETIME`
* `Phalcon\Db\Column::TYPE_CHAR`
* `Phalcon\Db\Column::TYPE_TEXT`

The associative array passed in `Phalcon\Db::createTable()` can have the possible keys:

| Index        | Description                                                                                                                            | Optional |
| ------------ | -------------------------------------------------------------------------------------------------------------------------------------- |:--------:|
| `columns`    | An array with a set of table columns defined with [Phalcon\Db\Column](api/Phalcon_Db_Column)                                         |    No    |
| `indexes`    | An array with a set of table indexes defined with [Phalcon\Db\Index](api/Phalcon_Db_Index)                                           |   Yes    |
| `references` | An array with a set of table references (foreign keys) defined with [Phalcon\Db\Reference](api/Phalcon_Db_Reference)                 |   Yes    |
| `options`    | An array with a set of table creation options. These options often relate to the database system in which the migration was generated. |   Yes    |

<a name='tables-altering'></a>

### Altering Tables

As your application grows, you might need to alter your database, as part of a refactoring or adding new features. Not all database systems allow to modify existing columns or add columns between two existing ones. [Phalcon\Db](api/Phalcon_Db) is limited by these constraints.

```php
<?php

use Phalcon\Db\Column as Column;

// Adding a new column
$connection->addColumn(
    'robots',
    null,
    new Column(
        'robot_type',
        [
            'type'    => Column::TYPE_VARCHAR,
            'size'    => 32,
            'notNull' => true,
            'after'   => 'name',
        ]
    )
);

// Modifying an existing column
$connection->modifyColumn(
    'robots',
    null,
    new Column(
        'name',
        [
            'type'    => Column::TYPE_VARCHAR,
            'size'    => 40,
            'notNull' => true,
        ]
    )
);

// Deleting the column 'name'
$connection->dropColumn(
    'robots',
    null,
    'name'
);
```

<a name='tables-dropping'></a>

### Dropping Tables

現在のデータベースから既存のテーブルをドロップするには、`dropTable` メソッドを使用します。 カスタム データベースからテーブルを削除するには、2 番目のパラメーターでデータベースの名前を指定します。 Examples on dropping tables:

```php
<?php

// アクティブなデータベースから 'robots' テーブルを削除
$connection->dropTable('robots');

// 'machines' データベースから 'robots' テーブルを削除 
$connection->dropTable('robots', 'machines');
```