資料庫名稱：comments

| 欄位名稱   | 欄位型態  | 說明       |
|------------|-----------|------------|
| id         | integer   | 留言 id    |
| nickname   | nvarchar  | 留言者暱稱 |
| content    | text      | 留言內容   |
| time       | timestamp | 留言時間   |
| parent_id  | integer   | 如果 0，表示為主留言；若為子留言則儲存主留言id。  |
