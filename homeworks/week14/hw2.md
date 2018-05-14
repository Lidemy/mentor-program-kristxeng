## 使用 CodeIgniter 之後跟原本寫純 PHP 有什麼不一樣的地方嗎？  
- CodeIgniter 把整個網站的架構都預設好了，MVC 的分工很清楚，對初學者來說，只要有簡單的 MVC 概念應該很容易照著架構開發；而純 PHP 則是要自己規劃架構，對我們這些初學者來說，容易把所有功能都包在一起，例如把 HTML、PHP 跟 SQL query 寫在同一個檔案裡。隔了一段時間，再回來看到自己之前寫的程式碼，就算當初有寫註解，可能也要好一段時間重新理解。  
- 很多可能會用到的功能，Codeigniter 都已經預先做好了，只需要在設定檔中開啟，或是 引用 library、helper function 進來，但純 PHP 開發就得看原生 PHP 有沒有類似的函式，或是自己寫。  
- 延續上一點，也因為 CodeIgniter 預先開發許多功能，整個網站會比純 PHP 寫的大上許多。

## 跟 Express 比起來，你比較喜歡哪個  
目前來說應該是 CodeIgniter 好一點。相對 Express 來說，在用 CodeIgniter 的時候好像比較知道該怎麼下手。  
一來因為 CodeIgniter 教學跟說明文件很詳細，做一次教學就大概可以知道 MVC 架構怎麼連動，而遇到的大部分的問題也都在文件裡面找得到答案。(話雖如此，我還是在 `xss_clean()` 卡了很久，後來才發現原來他功能跟 `htmlspecialchars()` 和 `htmlentities` 不相同，他並不是把指定字元轉換成 HTML Entities，而是把 `<script>`、`</script>`去掉了...)  
二來是 PHP 留言板優化更新過好多次，資料該怎麼來怎麼去也重寫了好多遍，套進 MVC 架構之後，Controller 該丟哪些資料給 View，跟 Model 拿到資料後該做什麼，好像變得更清晰了一點點唷。  