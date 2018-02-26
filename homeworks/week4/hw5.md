##1. 什麼是 DOM？##
- 全稱 Document Object Model  
- 定義了程式用以存取操作HTML文件架構和內容的標準介面和方法。 
 
##2. 什麼是 Ajax？##
- 全稱 Asynchronous JavaScript and XML (非同步 Javascript 與 XML 技術)  
- 使用 javascript 操作預先定義好的 XMLHttpRequest 物件向伺服器發出請求，並僅取回必須的資料，在不須刷新頁面的情況下，即可顯示取得的資料內容。而非如同傳統使用 form 傳送資料後，伺服器回傳完整頁面，瀏覽器必須刷新頁面後才能顯示資料。  

##3. HTTP method 有哪幾個？有什麼不一樣？##
http method 有 GET、POST、PUT、HEAD、DELET、PATCH、TRACE、CONNECT  
以在定義上來說：  
- GET 用於取得資源。  
- POST 用於新增資源。
- PUT 新增資源，如果資源已存在則更新內容。  
- HEAD 同 GET 為取資料用，但僅取得HTTP header。  
- DELETE 刪除指定項資料。  
- PATCH 對指定項資料做部分修改。  

##4. GET 跟 POST 有哪些區別，可以試著舉幾個例子嗎？##
- 以 GET 發出request時，要傳遞給伺服器的資料會以Query String (Key=Value)型式附加在網址上。以 google 搜尋關鍵字 restaurants 為例：`https://www.google.com.tw/search?q=restaurants`，關鍵字會以公開方式顯示，因此需要保密性資料不適合以 GET 方式傳送。  
- 以 POST 發出 request 時，傳送給伺服器的資料內容會包在 request 的 message body 內，而不會在網址上公開顯示，因此較具隱密性，需要保密性高的資料較適合使用此方式。  

##5. 什麼是 RESTful API？##
REST 全稱「Representational State Transfer」，指的是一種清晰明確語意來描述 Web操作的設計風格。  
RESTful api 主要應包含幾個原則：  
- 一個 URI 即代表一種資源。  
- 針對資源的操作都是使用正確 http method，例如不可將 GET 使用在刪除資料。  
- 選擇合適的status code 回應客戶端，例如 2XX 表示請求正常處理， 4XX 表示客戶端請求有錯誤...等。  
- 與http一樣，API 也應該是stateless。  
- 介面與資源分離，因此不需要與後端資料庫維持一對一關係。  

##6. JSON 是什麼？##
- 全稱 JavaScript Object Notation  
- 是一種依照 Javascript Object 語法的資料格式。
- 是儲存資料的格式，而不是程式語法，所以可以獨立使用。  

##7. JSONP 是什麼？##
JSONP 是讓網頁可以從別的網域取得資料的方法之一。利用`<script>`不受「同源政策」限制的特性，將參數以 GET 方式傳送給給跨來源伺服器，再將所需的資料以 callback function 包裹的方式帶回使用。  

##8. 要如何存取跨網域的 API？##
除了使用上題所提到的 JSONP之外，還可透過 CORS (跨域资源共享)標準，以AJAX的方式存取跨網域的API。CORS 全稱Cross-origin resource sharing，是 W3C 標準，其允許瀏覽器像跨來源伺服器發出`XMLHttpRequest`請求，而不受同源政策限制。
